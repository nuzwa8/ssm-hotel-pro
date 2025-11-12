/**
 * bssms-students-list.js
 * طالب علم کی فہرست (Students List) کی کلائنٹ سائیڈ لاجک کو سنبھالتا ہے۔
 * ڈیٹا لوڈنگ، فلٹرنگ، پیجینیشن اور ڈونٹ چارٹ رینڈرنگ شامل ہے۔
 */

(function ($) {
    // 🟢 یہاں سے Students List JS Logic شروع ہو رہا ہے
    
    // لسٹ کی بنیادی آبجیکٹس
    const listConfig = {
        root: '#bssms-students-list-root',
        templateId: 'bssms-students-list-template',
        currentPage: 1,
        perPage: 10,
        currentFilters: {},
    };

    let chartInstance = null; // Chart.js انسٹینس کو گلوبلی ٹریک کرنے کے لیے

    /**
     * طالب علم کی فہرست کے صفحہ کو شروع کریں۔
     */
    function initStudentsListPage() {
        if (BSSMS_UI.mountTemplate(listConfig.root, listConfig.templateId)) {
            populateCourseFilters();
            bindEvents();
            fetchStudentsData(); // پہلی بار ڈیٹا لوڈ کریں
            
            // اگر Chart.js دستیاب نہیں ہے تو انتباہ دیں (ہم فرض کرتے ہیں کہ یہ vendor/ میں موجود ہے)
            if (typeof Chart === 'undefined') {
                console.error("Developer Hint: Chart.js library (vendor/) is missing. Chart functionality will be disabled.");
            }
        }
    }

    /**
     * کورسز کے ڈیٹا کو فلٹر سلیکٹ فیلڈ میں شامل کریں۔
     */
    function populateCourseFilters() {
        const $select = $('#bssms-course-filter');
        // bssms_data.courses پہلے سے ہی assets.php سے لوکلائزڈ ہے
        bssms_data.courses.forEach(course => {
            $select.append(`<option value="${course.id}">${course.course_name_en} (${course.course_name_ur})</option>`);
        });
    }
    
    /**
     * AJAX کے ذریعے طالب علموں کا ڈیٹا حاصل کریں۔
     */
    function fetchStudentsData(page = 1) {
        listConfig.currentPage = page;
        
        // لوڈنگ اسٹیٹ دکھائیں
        const $tbody = $('#bssms-students-tbody');
        $tbody.html('<tr><td colspan="9" class="bssms-loading">🔄 ڈیٹا لوڈ ہو رہا ہے...</td></tr>');
        $('#bssms-admission-success-card').hide(); // کامیابی کا کارڈ چھپائیں

        // موجودہ فلٹرز کو اپ ڈیٹ کریں
        listConfig.currentFilters = {
            page: listConfig.currentPage,
            per_page: listConfig.perPage,
            search: $('#bssms-search-input').val().trim(),
            course_id: $('#bssms-course-filter').val(),
            status: $('#bssms-status-filter').val(),
            date_from: $('#date-from').val(),
            date_to: $('#date-to').val(),
        };

        BSSMS_UI.wpAjax('fetch_students', listConfig.currentFilters)
            .then(response => {
                renderTable(response.data.items);
                renderSummary(response.data.summary);
                renderPagination(response.data.total_items, response.data.per_page, response.data.current_page);
            })
            .catch(error => {
                $tbody.html('<tr><td colspan="9" class="bssms-error">❌ فہرست لوڈ کرنے میں خرابی پیش آئی۔</td></tr>');
                console.error('Students List Fetch Failed:', error);
            });
    }

    /**
     * ٹیبل میں ڈیٹا رینڈر کریں۔
     */
    function renderTable(items) {
        const $tbody = $('#bssms-students-tbody');
        $tbody.empty();
        
        if (items.length === 0) {
            $tbody.html('<tr><td colspan="9" class="bssms-no-results">کوئی ریکارڈ نہیں ملا۔</td></tr>');
            return;
        }

        items.forEach(item => {
            const isDue = item.due_amount > 0;
            const statusClass = isDue ? 'status-due' : 'status-paid';
            const date = new Date(item.admission_date);

            const row = `
                <tr data-id="${item.id}" class="${statusClass}">
                    <td>${item.id}</td>
                    <td>
                        <strong>${item.full_name_en}</strong>
                        <br><small class="bssms-urdu-text">(${item.full_name_ur})</small>
                    </td>
                    <td>${item.course_name_en}</td>
                    <td class="column-fee">₹${item.total_fee.toLocaleString()}</td>
                    <td class="column-fee status-paid">₹${item.paid_amount.toLocaleString()}</td>
                    <td class="column-fee status-due">₹${item.due_amount.toLocaleString()}</td>
                    <td class="center-col">
                        <a href="${item.payment_screenshot_url}" target="_blank" class="bssms-icon-btn" title="اسکرین شاٹ دیکھیں">🖼️</a>
                    </td>
                    <td>${date.toLocaleDateString('en-US')}</td>
                    <td>
                        <button class="bssms-icon-btn btn-edit" data-id="${item.id}" title="ایڈٹ کریں">✏️</button>
                        <button class="bssms-icon-btn btn-delete" data-id="${item.id}" title="حذف کریں">🗑️</button>
                    </td>
                </tr>
            `;
            $tbody.append(row);
        });
    }

    /**
     * سمری کارڈ میں ڈیٹا رینڈر کریں اور چارٹ بنائیں۔
     */
    function renderSummary(summary) {
        // اعداد و شمار کو فارمیٹ کریں
        const totalStudents = parseInt(summary.total_students) || 0;
        const totalIncome = parseInt(summary.total_income) || 0;
        const totalPaid = parseInt(summary.total_paid) || 0;
        const totalDue = parseInt(summary.total_due) || 0;

        $('#summary-total-students').text(totalStudents.toLocaleString());
        $('#summary-total-income').text(`₹${totalIncome.toLocaleString()}`);
        $('#summary-total-paid').text(`₹${totalPaid.toLocaleString()}`);
        $('#summary-total-due').text(`₹${totalDue.toLocaleString()}`);

        // ڈونٹ چارٹ رینڈر کریں (اگر Chart.js دستیاب ہے)
        if (typeof Chart !== 'undefined') {
             renderPaidDueChart(totalPaid, totalDue);
        }
    }

    /**
     * ڈونٹ چارٹ (Paid vs Due) رینڈر کریں۔
     */
    function renderPaidDueChart(paid, due) {
        const ctx = document.getElementById('paid-due-chart');
        
        // اگر چارٹ پہلے سے موجود ہے تو اسے Destroy کریں (Refactor Policy Rule 9)
        if (chartInstance) {
            chartInstance.destroy();
        }

        const paidPercent = Math.round((paid / (paid + due)) * 100);
        const duePercent = 100 - paidPercent;

        chartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [`Paid (${paidPercent}%)`, `Due (${duePercent}%)`],
                datasets: [{
                    data: [paid, due],
                    backgroundColor: [
                        'var(--bssms-color-secondary)', // Green for Paid
                        'var(--bssms-color-error)'    // Red for Due
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: bssms_data.theme_mode === 'dark' ? '#e0e0e0' : '#1e1e1e'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += `₹${context.parsed.toLocaleString()}`;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }
    
    /**
     * پیجینیشن لنکس رینڈر کریں۔
     */
    function renderPagination(totalItems, perPage, currentPage) {
        const totalPages = Math.ceil(totalItems / perPage);
        const $pagination = $('#bssms-pagination');
        $pagination.empty();

        if (totalPages <= 1) return;

        // سابقہ بٹن
        $pagination.append(`<button class="bssms-btn bssms-btn-pagination" data-page="${currentPage - 1}" ${currentPage === 1 ? 'disabled' : ''}>« Prev</button>`);

        // پیج نمبرز (سادگی کے لیے صرف موجودہ پیج اور اس کے آس پاس کے پیجز)
        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage || i <= 2 || i > totalPages - 2 || (i >= currentPage - 1 && i <= currentPage + 1)) {
                $pagination.append(`<button class="bssms-btn bssms-btn-pagination ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                $pagination.append(`<span class="bssms-pagination-dots">...</span>`);
            }
        }

        // اگلا بٹن
        $pagination.append(`<button class="bssms-btn bssms-btn-pagination" data-page="${currentPage + 1}" ${currentPage === totalPages ? 'disabled' : ''}>Next »</button>`);
    }

    /**
     * ریکارڈ حذف کریں (AJAX Call)
     */
    function handleDeleteRecord(id) {
        if (!confirm(bssms_data.messages.delete_confirm)) {
            return;
        }

        // بٹن کو غیر فعال کریں
        $(`tr[data-id="${id}"] .btn-delete`).prop('disabled', true).text('...');
        
        BSSMS_UI.wpAjax('delete_admission', { id: id })
            .then(response => {
                BSSMS_UI.displayMessage('Success', bssms_data.messages.delete_success, 'success');
                fetchStudentsData(listConfig.currentPage); // ڈیٹا ریفریش کریں
            })
            .catch(error => {
                // اگر خرابی ہو تو بٹن کو دوبارہ فعال کریں
                $(`tr[data-id="${id}"] .btn-delete`).prop('disabled', false).text('🗑️');
                console.error('Delete Failed:', error);
            });
    }

    /**
     * تمام (DOM) ایونٹس کو باندھیں۔
     */
    function bindEvents() {
        // فلٹر اور سرچ ان پٹ پر تبدیلی پر ڈیٹا ریفریش کریں
        $('#bssms-search-input, #bssms-course-filter, #bssms-status-filter, #date-from, #date-to').on('change keyup', function() {
            // سرچ کے لیے تھوڑا انتظار کریں (Debounce)
            if (this.id === 'bssms-search-input') {
                clearTimeout($(this).data('timeout'));
                $(this).data('timeout', setTimeout(() => fetchStudentsData(1), 500));
            } else {
                fetchStudentsData(1);
            }
        });
        
        // پیجینیشن کلک ہینڈلر
        $(listConfig.root).on('click', '.bssms-btn-pagination:not([disabled])', function() {
            const page = $(this).data('page');
            fetchStudentsData(page);
        });

        // ٹیبل ایکشنز (Delete, Edit)
        $(listConfig.root).on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            handleDeleteRecord(id);
        });
        
        $(listConfig.root).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            BSSMS_UI.displayMessage('Info', `ریکارڈ #${id} کو ایڈٹ کرنے کا فنکشن جلد شامل کیا جائے گا۔`, 'info');
            // ایڈٹ فنکشنلٹی (Edit Functionality) بعد میں شامل کی جائے گی۔
        });
        
        // Add New بٹن کا کلک ہینڈلر
        $('#btn-add-new-student').on('click', function() {
            // داخلہ فارم کے صفحے پر جائیں
            window.location.href = `admin.php?page=${bssms_data.pages.admission}`;
        });
    }

    // جب DOM تیار ہو جائے تو صفحہ شروع کریں
    $(document).ready(function () {
        if ($(listConfig.root).length) {
            initStudentsListPage();
        }
    });

    // 🔴 یہاں پر Students List JS Logic ختم ہو رہا ہے
})(jQuery);

// ✅ Syntax verified block end
