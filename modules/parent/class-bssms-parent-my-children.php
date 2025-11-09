<?php
/**
 * BSSMS Parent 'My Children' Page
 *
 * @package BSSMS
 */

// 🟢 یہاں سے [Parent My Children Class] شروع ہو رہا ہے
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * 'میرے بچے' پیج کو رینڈر (render) کرتا ہے۔
 * سخت پابندی: اس فائل میں صرف लेआउट (layout) شامل ہے۔ کوئی AJAX یا DB کالز نہیں ہیں۔
 */
class BSSMS_Parent_My_Children {

	/**
	 * صفحہ کو رینڈر کرتا ہے۔
	 */
	public static function render_page() {

		// 🟢 یہاں سے [Page Root] شروع ہو رہا ہے
		?>
		<div id="bssms-parent-my-children-root" class="bssms-root" data-screen="my-children">
			<p>Loading My Children...</p>
		</div>
		<?php
		// 🔴 یہاں پر [Page Root] ختم ہو رہا ہے

		// 🟢 یہاں سے [Page Template] شروع ہو رہا ہے
		?>
		<template id="bssms-parent-my-children-template">
			<div class="bssms-parent-my-children">
				
				<div class="bssms-page-header">
					<h1><?php _e( 'My Children', 'bssms' ); ?></h1>
					<div class="bssms-header-actions">
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Export', 'bssms' ); ?></button>
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'PDF', 'bssms' ); ?></button>
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Excel', 'bssms' ); ?></button>
					</div>
				</div>

				<div class="bssms-breadcrumbs">
					<span><?php _e( 'Parent', 'bssms' ); ?></span> &gt; 
					<span><?php _e( 'My Children', 'bssms' ); ?></span>
				</div>

				<div class="bssms-toolbar">
					<div class="search-box">
						<input type="text" placeholder="<?php _e( 'Search...', 'bssms' ); ?>" />
						<span class="icon-search"></span>
					</div>
					<div class="filters">
						<span><?php _e( 'Filters', 'bssms' ); ?></span>
					</div>
					<div class="view-switch">
						<span><?php _e( 'Switch to Table View', 'bssms' ); ?></span>
					</div>
					<button class="bssms-btn-link"><?php _e( 'Clear All', 'bssms' ); ?></button>
				</div>

				<div class="bssms-stats-bar">
					<div class="stat-item"><?php _e( 'Total Children:', 'bssms' ); ?> <strong>3</strong></div>
					<div class="stat-item"><?php _e( 'Pending Fees:', 'bssms' ); ?> <strong>2</strong></div>
					<div class="stat-item"><?php _e( 'Late:', 'bssms' ); ?> <strong>1</strong></div>
					<div class="stat-item"><?php _e( 'Transport Risk (A!):', 'bssms' ); ?> <strong>1</strong></div>
					<button class="bssms-btn bssms-btn-primary"><?php _e( 'Manage Alerts', 'bssms' ); ?></button>
				</div>

				<div class="bssms-children-grid">
					
					<div class="bssms-child-card">
						<div class="card-header">
							<img src="" alt="Aysha Khan" class="child-avatar" />
							<div class="child-info">
								<h3><?php _e( 'Aysha Khan', 'bssms' ); ?></h3>
								<span><?php _e( 'Class: 7-B', 'bssms' ); ?></span>
								<span class="status-tag status-active"><?php _e( 'Active', 'bssms' ); ?></span>
							</div>
						</div>
						<div class="card-body">
							<h4><?php _e( 'PKR 15,000', 'bssms' ); ?></h4>
							<span class="sub-label"><?php _e( 'Total Due', 'bssms' ); ?></span>
							
							<ul class="quick-info-list">
								<li><span class="icon-alert"></span><?php _e( 'Attendance Alerts', 'bssms' ); ?></li>
								<li><span class="icon-fee"></span><?php _e( 'Overdue Fees', 'bssms' ); ?></li>
								<li><span class="icon-transport"></span><?php _e( 'Transport Request', 'bssms' ); ?></li>
								<li><span class="icon-scholar"></span><?php _e( 'Day Scholar', 'bssms' ); ?></li>
							</ul>
						</div>
						<div class="card-footer">
							<button class="bssms-btn bssms-btn-primary"><?php _e( 'View (Pay Now)', 'bssms' ); ?></button>
							<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Attendance', 'bssms' ); ?></button>
						</div>
					</div>

					<div class="bssms-child-card">
						<div class="card-header">
							<img src="" alt="Fatima Khan" class="child-avatar" />
							<div class="child-info">
								<h3><?php _e( 'Fatima Khan', 'bssms' ); ?></h3>
								<span><?php _e( 'Class: 7-B', 'bssms' ); ?></span>
								<span class="status-tag status-active"><?php _e( 'Active', 'bssms' ); ?></span>
							</div>
						</div>
						<div class="card-body">
							<h4><?php _e( 'PKR 18,000', 'bssms' ); ?></h4>
							<span class="sub-label"><?php _e( 'Total Due', 'bssms' ); ?></span>
							
							<ul class="quick-info-list">
								<li><span class="icon-alert"></span><?php _e( 'Attendance Alerts', 'bssms' ); ?></li>
								<li><span class="icon-homework"></span><?php _e( 'Homework', 'bssms' ); ?></li>
								<li><span class="icon-transport"></span><?php _e( 'Transport Request', 'bssms' ); ?></li>
								<li><span class="icon-fee"></span><?php _e( '2 fees', 'bssms' ); ?></li>
								<li><span class="icon-scholar"></span><?php _e( 'Day Scholar', 'bssms' ); ?></li>
							</ul>
						</div>
						<div class="card-footer">
							<button class="bssms-btn bssms-btn-primary"><?php _e( 'View (Pay Now)', 'bssms' ); ?></button>
							<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Results (B+)', 'bssms' ); ?></button>
						</div>
					</div>

					</div>

				<div class="bssms-page-footer-info">
					<span><?php _e( 'Last Login: Smart', 'bssms' ); ?></span>
					<span><?php _e( 'Last Payment: 10 Nov', 'bssms' ); ?></span>
					<span><?php _e( 'Next due: 25 Nov', 'bssms' ); ?></span>
				</div>


				<div class="bssms-modal-backdrop" id="fee-payment-modal-placeholder" style="display: none;">
					<div class="bssms-modal">
						<div class="modal-header">
							<h3><?php _e( 'Pay Securely', 'bssms' ); ?></h3>
							<button class="modal-close-btn">&times;</button>
						</div>
						<div class="modal-body">
							<p><?php _e( 'Aysha Khan', 'bssms' ); ?></p>
							</div>
						<div class="modal-footer">
							<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Cancel', 'bssms' ); ?></button>
							<button class="bssms-btn bssms-btn-primary"><?php _e( 'Pay Securely', 'bssms' ); ?></button>
						</div>
					</div>
				</div>


			</div>
		</template>
		<?php
		// 🔴 یہاں پر [Page Template] ختم ہو رہا ہے
	}
}
// 🔴 یہاں پر [Parent My Children Class] ختم ہو رہا ہے

// ✅ Syntax verified block end.
