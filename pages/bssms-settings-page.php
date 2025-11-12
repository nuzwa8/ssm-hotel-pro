<?php
/**
 * BSSMS_Settings_Page کلاس
 * سسٹم ترتیبات کے صفحہ کی (PHP) لاجک اور ٹیمپلیٹ کو سنبھالتی ہے۔
 * قاعدہ 30 کے تحت یہ ایک سرشار (Dedicated) فائل ہے۔
 * قاعدہ 29: لازمی فیچرز شامل ہیں۔
 */
class BSSMS_Settings_Page {

	/**
	 * سسٹم ترتیبات کے صفحہ کو رینڈر کریں۔
	 */
	public static function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'آپ کے پاس اس صفحہ تک رسائی کی اجازت نہیں ہے۔', 'bssms' ) );
		}
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'سسٹم ترتیبات', 'bssms' ); ?> <span style="font-size:14px; color:#999; margin-left:10px;">(Customize your plugin appearance and behavior)</span></h2>
			<div class="bssms-message-container"></div>
			<div id="bssms-settings-root">
				<?php 
				self::render_settings_template();
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * ترتیبات کے لیے (PHP) ٹیمپلیٹ بلاک کو رینڈر کریں۔
	 * قاعدہ 4: مکمل <template> blocks
	 */
	private static function render_settings_template() {
		?>
		<template id="bssms-settings-form-template">
			<form id="bssms-settings-form" class="bssms-settings-grid" enctype="multipart/form-data">
				
				<div class="bssms-nav-sidebar">
					<button type="button" class="bssms-nav-item active" data-section="general">
						<span class="dashicons dashicons-admin-generic"></span> General Settings (عمومی)
					</button>
					<button type="button" class="bssms-nav-item" data-section="theme">
						<span class="dashicons dashicons-admin-appearance"></span> Theme & Branding
					</button>
					<button type="button" class="bssms-nav-item" data-section="language">
						<span class="dashicons dashicons-translation"></span> Language Settings (زبان)
					</button>
					<button type="button" class="bssms-nav-item" data-section="defaults">
						<span class="dashicons dashicons-controls-repeat"></span> Default Cards (ڈیفالٹس)
					</button>
				</div>
				
				<div class="bssms-settings-content">
					
					<div class="bssms-setting-section bssms-card" id="settings-general">
						<h3 class="section-title">🏠 عمومی ترتیبات (General Settings)</h3>
						
						<div class="bssms-form-group">
							<label for="academy_name" class="bssms-label">Academy Name (اکیڈمی کا نام)</label>
							<input type="text" id="academy_name" name="academy_name" class="bssms-input">
						</div>
						
						<div class="bssms-form-group">
							<label for="admin_email" class="bssms-label">Admin Email (ایڈمن ای میل)</label>
							<input type="email" id="admin_email" name="admin_email" class="bssms-input">
						</div>
						
						<div class="bssms-form-group">
							<label for="default_currency" class="bssms-label">Default Currency (ڈیفالٹ کرنسی)</label>
							<select id="default_currency" name="default_currency" class="bssms-select">
								<option value="PKR">PKR - Pakistan Rupees</option>
								<option value="USD">USD - US Dollar</option>
							</select>
						</div>
						
						<div class="bssms-form-group">
							<label for="date_format" class="bssms-label">Date Format (تاریخ کا فارمیٹ)</label>
							<input type="text" id="date_format" name="date_format" class="bssms-input" placeholder="مثلاً: DD-MM-YYYY">
						</div>
						
						<div class="bssms-form-group">
							<label class="bssms-label">Logo Management (لوگو مینجمنٹ)</label>
							<input type="file" id="logo_file" name="logo_file" class="bssms-input-file" accept="image/*">
							<input type="hidden" id="logo_url_hidden" name="logo_url" value="">
							<div class="bssms-logo-preview">
								<img id="current-logo-img" src="" alt="لوگو" style="max-height: 80px; margin-top: 10px; display: none;">
								<button type="button" class="bssms-btn bssms-btn-danger" id="btn-remove-logo" style="display: none;">Remove Logo (لوگو ہٹائیں)</button>
							</div>
						</div>
					</div>
					
					<div class="bssms-setting-section bssms-card" id="settings-theme" style="display:none;">
						<h3 class="section-title">🎨 تھیم اور برانڈنگ (Theme & Branding)</h3>
						
						<div class="bssms-form-group bssms-toggle-group">
							<label class="bssms-label">Theme Mode: <span id="current-theme-mode">Light</span></label>
							<input type="checkbox" id="theme_mode_toggle" name="theme_mode" data-setting-key="theme_mode">
						</div>
						
						<div class="bssms-form-group">
							<label for="primary_color" class="bssms-label">Primary Color (بنیادی رنگ)</label>
							<input type="color" id="primary_color" name="primary_color" class="bssms-input-color">
							<small class="bssms-hint" id="color-hex-display"></small>
						</div>
						
						<button type="button" class="bssms-btn bssms-btn-secondary" id="btn-reset-color">Reset to Default Color</button>
					</div>
					
					<div class="bssms-setting-section bssms-card" id="settings-language" style="display:none;">
						<h3 class="section-title">🇵🇰 زبان کی ترتیبات (Language Settings)</h3>
						
						<div class="bssms-form-group bssms-toggle-group">
							<label class="bssms-label">Enable Bilingual Labels (دو لسانی لیبلز فعال کریں)</label>
							<input type="checkbox" id="enable_bilingual_labels" name="enable_bilingual_labels" checked>
						</div>
						
						<div class="bssms-form-group bssms-toggle-group">
							<label class="bssms-label">Enable Auto Urdu Translation (انگلش ان پٹ کا خودکار اردو ترجمہ)</label>
							<input type="checkbox" id="enable_auto_urdu_translation" name="enable_auto_urdu_translation" checked>
						</div>
					</div>
					
					<div class="bssms-setting-section bssms-card" id="settings-defaults" style="display:none;">
						<h3 class="section-title">🗄️ ڈیفالٹ کارڈز (Default Cards)</h3>
						
						<div class="bssms-form-group">
							<button type="button" class="bssms-btn bssms-btn-info">Backup Settings</button>
							<button type="button" class="bssms-btn bssms-btn-info">Export Data (Excel)</button>
						</div>
						
						<div class="bssms-form-group">
							<button type="button" class="bssms-btn bssms-btn-danger" id="btn-restore-defaults">⚠️ Restore Defaults (فیکٹری ری سیٹ)</button>
						</div>
					</div>
				</div>
				
				<div class="bssms-form-actions bssms-col-span-full">
					<button type="submit" class="bssms-btn bssms-btn-primary" id="btn-save-settings">💾 Save Changes (محفوظ کریں)</button>
					<button type="button" class="bssms-btn bssms-btn-secondary" id="btn-reset-all">Reset All (تمام تبدیلیاں کالعدم)</button>
					<button type="submit" class="bssms-btn bssms-btn-info" id="btn-save-exit">Save & Exit (محفوظ کر کے نکلیں)</button>
				</div>
				
			</form>
		</template>
		<?php
	}
}

// ✅ Syntax verified block end
