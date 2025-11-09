<?php
/**
 * BSSMS Parent Dashboard Page
 *
 * @package BSSMS
 */

// 🟢 یہاں سے [Parent Dashboard Class] شروع ہو رہا ہے
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * پیرنٹ ڈیش بورڈ پیج کو رینڈر (render) کرتا ہے۔
 * سخت پابندی: اس فائل میں صرف लेआउट (layout) شامل ہے۔ کوئی AJAX یا DB کالز نہیں ہیں۔
 */
class BSSMS_Parent_Dashboard {

	/**
	 * صفحہ کو رینڈر کرتا ہے۔
	 */
	public static function render_page() {

		// 🟢 یہاں سے [Page Root] شروع ہو رہا ہے
		?>
		<div id="bssms-parent-dashboard-root" class="bssms-root" data-screen="dashboard">
			<p>Loading Parent Dashboard...</p>
		</div>
		<?php
		// 🔴 یہاں پر [Page Root] ختم ہو رہا ہے

		// 🟢 یہاں سے [Page Template] شروع ہو رہا ہے
		?>
		<template id="bssms-parent-dashboard-template">
			<div class="bssms-parent-dashboard">
				
				<div class="bssms-page-header">
					<h1><?php _e( 'Parent Dashboard', 'bssms' ); ?></h1>
					<div class="bssms-header-actions">
						</div>
				</div>

				<div class="bssms-breadcrumbs">
					<span><?php _e( 'Dashboard', 'bssms' ); ?></span> &gt; 
					<span><?php _e( 'Parent', 'bssms' ); ?></span>
				</div>

				<div class="bssms-stats-grid">
					
					<div class="bssms-stat-card" id="stat-children">
						<div class="card-icon-container">
							<span class="child-icon"></span>
							<span class="child-icon"></span>
							<span class="child-icon"></span>
						</div>
						<div class="card-content">
							<span classs="card-value">3</span>
							<span class="card-label"><?php _e( 'Children', 'bssms' ); ?></span>
						</div>
					</div>

					<div class="bssms-stat-card" id="stat-attendance">
						<div class="card-content">
							<span class="card-value">85%</span>
							<span class="card-label"><?php _e( 'Attendance Summary', 'bssms' ); ?></span>
							<span class="card-sublabel"><?php _e( 'Overall', 'bssms' ); ?></span>
						</div>
						<div class="card-chart">
							<div class="mini-bar" style="height: 60%;"></div>
							<div class="mini-bar" style="height: 85%;"></div>
							<div class="mini-bar" style="height: 70%;"></div>
						</div>
					</div>

					<div class="bssms-stat-card" id="stat-fees">
						<div class="card-header-icon">
							<button class="icon-button">&times;</button>
						</div>
						<div class="card-content">
							<span class="card-label"><?php _e( 'Fee Status', 'bssms' ); ?></span>
							<span class="card-value-small"><?php _e( 'Paid:', 'bssms' ); ?> $1200 | $1300</span>
							<span class="card-sublabel-due"><?php _e( 'Due (Today):', 'bssms' ); ?> <span class="due-amount">$100</span></span>
							<span class="card-sublabel"><?php _e( 'Next Date:', 'bssms' ); ?> Oct 15</span>
						</div>
					</div>
				</div>

				<div class="bssms-dashboard-grid-main">
					
					<div class="bssms-grid-col-left">
						
						<div class="bssms-widget-card" id="widget-performance">
							<h3 class="widget-title"><?php _e( 'Performance & Attendance', 'bssms' ); ?></h3>
							<div class="widget-content-split">
								<div class="split-section" id="attendance-calendar">
									<h4 class="sub-title"><?php _e( 'Attendance', 'bssms' ); ?></h4>
									<span class="sub-label"><?php _e( 'October 2024', 'bssms' ); ?></span>
									<div class="calendar-placeholder">
										[<?php _e( 'Attendance Calendar UI', 'bssms' ); ?>]
									</div>
								</div>
								<div class="split-section" id="academic-performance">
									<h4 class="sub-title"><?php _e( 'Academic Performance', 'bssms' ); ?></h4>
									<div class="bar-chart-placeholder">
										[<?php _e( 'Academic Bar Chart', 'bssms' ); ?>]
									</div>
								</div>
							</div>
						</div>

						<div class="bssms-widget-card" id="widget-messages">
							<h3 class="widget-title"><?php _e( 'Recent Messages & Announcements', 'bssms' ); ?></h3>
							<ul class="message-list">
								</ul>
						</div>

					</div>

					<div class="bssms-grid-col-right">

						<div class="bssms-widget-card" id="widget-fee-overview">
							<h3 class="widget-title"><?php _e( 'Fee Overview', 'bssms' ); ?></h3>
							<table class="bssms-data-table">
								<thead>
									<tr>
										<th><?php _e( 'Child Name', 'bssms' ); ?></th>
										<th><?php _e( 'Child Due', 'bssms' ); ?></th>
										<th><?php _e( 'Status', 'bssms' ); ?></th>
										<th><?php _e( 'Action', 'bssms' ); ?></th>
									</tr>
								</thead>
								<tbody>
									</tbody>
							</table>
							<div class="widget-actions-footer">
								<button class="bssms-btn bssms-btn-primary"><?php _e( 'Pay Now', 'bssms' ); ?></button>
								<button class="bssms-btn-link"><?php _e( 'Jazz/EasyPaisa', 'bssms' ); ?></button>
							</div>
						</div>

						<div class="bssms-widget-card" id="widget-transport">
							<h3 class="widget-title"><?php _e( 'Transport Tracking', 'bssms' ); ?></h3>
							<div class="transport-map-placeholder">
								[<?php _e( 'Map UI', 'bssms' ); ?>]
							</div>
							<div class="transport-details">
								<span><?php _e( 'Driver: Mian Saqib', 'bssms' ); ?></span>
								<span><?php _e( 'ETA: 10 mins', 'bssms' ); ?></span>
								<button class="bssms-btn-link"><?php _e( 'View', 'bssms' ); ?></button>
							</div>
						</div>

						<div class="bssms-widget-card" id="widget-quick-links">
							<h3 class="widget-title"><?php _e( 'Quick Links', 'bssms' ); ?></h3>
							<div class="quick-links-grid">
								<button class="bssms-btn bssms-btn-secondary"><?php _e( 'My Children', 'bssms' ); ?></button>
								<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Fee Payments', 'bssms' ); ?></button>
								<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Results', 'bssms' ); ?></button>
								<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Messages', 'bssms' ); ?></button>
								<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Attendance Tracker', 'bssms' ); ?></button>
							</div>
						</div>

					</div>
				</div>

			</div>
		</template>
		<?php
		// 🔴 یہاں پر [Page Template] ختم ہو رہا ہے
	}
}
// 🔴 یہاں پر [Parent Dashboard Class] ختم ہو رہا ہے

// ✅ Syntax verified block end.
