<?php
/**
 * BSSMS Parent 'Transport Tracking' Page
 *
 * @package BSSMS
 */

// 🟢 یہاں سے [Parent Transport Tracking Class] شروع ہو رہا ہے
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * 'ٹرانسپورٹ ٹریکنگ' پیج کو رینڈر (render) کرتا ہے۔
 * سخت پابندی: اس فائل میں صرف लेआउट (layout) شامل ہے۔ کوئی AJAX یا DB کالز نہیں ہیں۔
 */
class BSSMS_Parent_Transport {

	/**
	 * صفحہ کو رینڈر کرتا ہے۔
	 */
	public static function render_page() {

		// 🟢 یہاں سے [Page Root] شروع ہو رہا ہے
		?>
		<div id="bssms-parent-transport-root" class="bssms-root" data-screen="transport">
			<p>Loading Transport Tracking...</p>
		</div>
		<?php
		// 🔴 یہاں پر [Page Root] ختم ہو رہا ہے

		// 🟢 یہاں سے [Page Template] شروع ہو رہا ہے
		?>
		<template id="bssms-parent-transport-template">
			<div class="bssms-parent-transport">
				
				<div class="bssms-page-header">
					<h1><?php _e( 'Transport Tracking', 'bssms' ); ?></h1>
					<div class="bssms-header-actions">
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Map', 'bssms' ); ?></button>
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'List', 'bssms' ); ?></button>
						<button class="bssms-btn bssms-btn-secondary"><?php _e( 'Share', 'bssms' ); ?></button>
						<button class="bssms-btn bssms-btn-secondary"><?pxp _e( 'Export', 'bssms' ); ?></button>
					</div>
				</div>

				<div class="bssms-toolbar">
					<div class="bssms-breadcrumbs">
						<span><?php _e( 'Parent', 'bssms' ); ?></span> &gt; 
						<span><?php _e( 'Transport Tracking', 'bssms' ); ?></span>
					</div>
					<div class="filters">
						</div>
				</div>

				<div class="bssms-stats-grid-transport">
					<div class="bssms-stat-card">
						<span class="card-label"><?php _e( 'Current Bus', 'bssms' ); ?></span>
						<span class="card-value">BSS-Bus-07</span>
					</div>
					<div class="bssms-stat-card">
						<span class="card-label"><?php _e( 'Driver', 'bssms' ); ?></span>
						<span class="card-value">Imran Ali</span>
					</div>
					<div class="bssms-stat-card">
						<span class="card-label"><?php _e( 'ETA to Stop', 'bssms' ); ?></span>
						<span class="card-value">06 min</span>
					</div>
					<div class="bssms-stat-card">
						<span class="card-label"><?php _e( 'ETA to Stop', 'bssms' ); ?></span>
						<span class="card-value">06 min</span>
					</div>
					<div class="bssms-stat-card">
						<span class="card-label"><?php _e( 'Last Update', 'bssms' ); ?></span>
						<span class="card-value">10:30 AM</span>
					</div>
				</div>

				<div class="bssms-layout-grid-2col-transport">
					
					<div class="bssms-grid-col-left">
						<div class="bssms-widget-card" id="widget-map-view">
							<div class="widget-toolbar">
								<span><?php _e( 'Live Status', 'bssms' ); ?></span>
								<div class="map-controls">
									<label><input type="checkbox" /> <?php _e( 'Fit to-fout', 'bssms' ); ?></label>
									<button class="icon-button" aria-label="<?php _e('Reload', 'bssms'); ?>"></button>
									<button class="icon-button" aria-label="<?php _e('Home', 'bssms'); ?>"></button>
								</div>
							</div>
							<div class="map-placeholder">
								[<?php _e( 'Live Map Interface', 'bssms' ); ?>]
							</div>
						</div>
					</div>

					<div class="bssms-grid-col-right">
						
						<div class="bssms-widget-card" id="widget-bus-timeline">
							<h3 class="widget-title"><?php _e( 'Bus Timeline', 'bssms' ); ?></h3>
							<ul class="timeline-list">
								<li class="timeline-item active">
									<span><?php _e( 'Depart (9:00 AM)', 'bssms' ); ?></span>
									<span class="status-icon"></span>
								</li>
								<li class="timeline-item">
									<span><?php _e( 'Dried Raza\'s Stop', 'bssms' ); ?></span>
									<span class="status-icon"></span>
								</li>
								<li class="timeline-item on-time">
									<span><?php _e( 'Next Stop Sulken Gate', 'bssms' ); ?></span>
									<span class="status-tag"><?php _e( 'On Time', 'bssms' ); ?></span>
								</li>
								<li class="timeline-item">
									<span><?php _e( 'Call Driver', 'bssms' ); ?></span>
									<span class="status-icon"></span>
								</li>
								<li class="timeline-item">
									<span><?php _e( 'School', 'bssms' ); ?></span>
									<span class="status-icon"></span>
								</li>
							</ul>
						</div>

						<div class="bssms-widget-card" id="widget-bus-driver-details">
							<div class="bus-details">
								<h4><?php _e( 'Bus: BSS-Bus-07', 'bssms' ); ?></h4>
								<p><?php _e( 'Driver: Imran Ali', 'bssms' ); ?></p>
								<div class="details-actions">
									<button class="bssms-btn-link"><?php _e( 'Call Driver', 'bssms' ); ?></button>
									<button class="bssms-btn-link"><?php _e( 'Message Transport', 'bssms' ); ?></button>
								</div>
								
								<h5><?php _e( 'Bus & Driver', 'bssms' ); ?></h5>
								<p><?php _e( 'Capacity: 45', 'bssms' ); ?></p>
								<p><?php _e( 'Plate: ABC-123', 'bssms' ); ?></p>
								
								<h5><?php _e( 'Driver Iniver', 'bssms' ); ?></h5>
								<p><?php _e( 'License Exp: ...', 'bssms' ); ?></p>
							</div>
						</div>

						<div class="bssms-widget-card" id="widget-pickup-code">
							<h3 class="widget-title"><?php _e( 'Child Pickup Code', 'bssms' ); ?></h3>
							<div class="qr-code-placeholder">
								[<?php _e( 'QR Code', 'bssms' ); ?>]
							</div>
							<div class="pickup-code">
								123556
							</div>
							<p><?php _e( 'Use this code or show QR code at driver/conductor.', 'bssms' ); ?></p>
							<button class="bssms-btn bssms-btn-danger"><?php _e( 'SOS - Report Safety Concern', 'bssms' ); ?></button>
						</div>

					</div>
				</div>

			</div>
		</template>
		<?php
		// 🔴 یہاں پر [Page Template] ختم ہو رہا ہے
	}
}
// 🔴 یہاں پر [Parent Transport Tracking Class] ختم ہو رہا ہے

// ✅ Syntax verified block end.
