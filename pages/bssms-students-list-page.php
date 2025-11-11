<?php
/**
 * BSSMS_Students_List_Page کلاس
 * طالب علم کی فہرست (Students List) کے صفحہ کی (PHP) لاجک اور ٹیمپلیٹ کو سنبھالتی ہے۔
 * قاعدہ 30 کے تحت یہ ایک سرشار (Dedicated) فائل ہے۔
 */
class BSSMS_Students_List_Page {

	/**
	 * طالب علم کی فہرست کے صفحہ کو رینڈر کریں۔
	 */
	public static function render_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'تمام داخلہ شدہ طالب علم', 'bssms' ); ?> <span style="font-size:14px; color:#999; margin-left:10px;">(All Enrolled Students)</span></h2>
			<div class="bssms-message-container"></div>
			<div id="bssms-students-list-root">
				<?php 
				self::render_list_template();
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * طالب علم کی فہرست کے لیے (PHP) ٹیمپلیٹ بلاک کو رینڈر کریں۔
	 * قاعدہ 4: مکمل <template> blocks
	 */
	private static function render_list_template() {
		?>
		<template id="bssms-students-list-template">
			<div class="bssms-list-wrapper">
				
				<div class="bssms-toolbar">
					<div class="bssms-filter-area">
						<input type="text" id="bssms-search-input" class="bssms-input" placeholder="🔍 نام یا ID سے تلاش کریں...">
						
						<select id="bssms-course-filter" class="bssms-select">
							<option value="0">تمام کورسز</option>
							</select>
						
						<select id="bssms-status-filter" class="bssms-select">
							<option value="">تمام حیثیت</option>
							<option value="paid">✅ ادا شدہ (Paid)</option>
							<option value="due">❌ بقایا (Due)</option>
						</select>
					</div>

					<div class="bssms-date-range">
						<label for="date-from" class="bssms-label">از</label>
						<input type="date" id="date-from" class="bssms-input">
						<label for="date-to" class="bssms-label">تا</label>
						<input type="date" id="date-to" class="bssms-input">
					</div>
				</div>
				
				<div class="bssms-main-content">
					<div class="bssms-list-table-container">
						<table class="bssms-table" id="bssms-students-table">
							<thead>
								<tr>
									<th>ID #</th>
									<th>Full Name (نام)</th>
									<th>Course (کورس)</th>
									<th class="column-fee">Total Fee (کل فیس)</th>
									<th class="column-fee">Paid Amount (ادا شدہ)</th>
									<th class="column-fee">Due Amount (بقایا)</th>
									<th>Payment Screenshot</th>
									<th>Admission Date (تاریخ داخلہ)</th>
									<th>Actions (ایکشنز)</th>
								</tr>
							</thead>
							<tbody id="bssms-students-tbody">
								<tr><td colspan="9" class="bssms-loading">لوڈ ہو رہا ہے...</td></tr>
							</tbody>
						</table>
						
						<div class="bssms-footer-actions">
							<div class="bssms-pagination" id="bssms-pagination">
								</div>

							<div class="bssms-global-actions">
								<button class="bssms-btn bssms-btn-info" id="btn-export-excel">📊 Excel Download</button>
								<button class="bssms-btn bssms-btn-info" id="btn-print-list">🖨️ Print List</button>
								<button class="bssms-btn bssms-btn-success" id="btn-add-new-student">➕ Add New</button>
							</div>
						</div>
					</div>

					<div class="bssms-summary-sidebar">
						<div class="bssms-card bssms-summary-card">
							<h4 class="section-title">📊 رپورٹ کا خلاصہ (Summary Report)</h4>
							<p><strong>Total Students:</strong> <span id="summary-total-students">0</span></p>
							<p><strong>Total Income:</strong> <span id="summary-total-income">₹0</span></p>
							<p><strong>Total Paid:</strong> <span id="summary-total-paid">₹0</span></p>
							<p><strong>Total Due:</strong> <span id="summary-total-due">₹0</span></p>
							
							<canvas id="paid-due-chart" width="200" height="200"></canvas>
						</div>
					</div>
				</div>
			</div>
		</template>
		<?php
	}
}

// ✅ Syntax verified block end
