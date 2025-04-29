<?php
/**
 * Plugin Name: Unit of Information Converter
 * Description: Converts bits, bytes, kilobytes, and other units of information including SI to IEC conversion.
 * Version: 1.0
 * Author: Dimitrios Charalampidis
 */

// Enqueue styles and scripts
function info_unit_converter_enqueue() {
    wp_enqueue_style('info-unit-converter-css', plugins_url('/style.css', __FILE__));
    wp_enqueue_script('info-unit-converter-js', plugins_url('/info-unit-converter.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'info_unit_converter_enqueue');

// Shortcode to display the converter
function info_unit_converter_shortcode() {
  ob_start();
?>
  <div class="iuc-wrapper">
    <form id="iuc-form">
      <?php wp_nonce_field('iuc_convert_action', 'iuc_nonce_field'); ?>

      <label for="input_value">Enter Value:</label>
      <input type="number" id="iuc-input-value" placeholder="Enter a number" required>

      <label for="iuc-from-unit">Convert from:</label>
      <select id="iuc-from-unit">
        <option value="bit">Bit</option>
        <option value="byte">Byte</option>
        <option value="kB">Kilobyte (kB)</option>
        <option value="MB">Megabyte (MB)</option>
        <option value="GB">Gigabyte (GB)</option>
        <option value="TB">Terabyte (TB)</option>
        <option value="KiB">Kibibyte (KiB)</option>
        <option value="MiB">Mebibyte (MiB)</option>
        <option value="GiB">Gibibyte (GiB)</option>
        <option value="TiB">Tebibyte (TiB)</option>
      </select>

      <label for="iuc-to-unit">Convert to:</label>
      <select id="iuc-to-unit">
        <option value="bit">Bit</option>
        <option value="byte">Byte</option>
        <option value="kB">Kilobyte (kB)</option>
        <option value="MB">Megabyte (MB)</option>
        <option value="GB">Gigabyte (GB)</option>
        <option value="TB">Terabyte (TB)</option>
        <option value="KiB">Kibibyte (KiB)</option>
        <option value="MiB">Mebibyte (MiB)</option>
        <option value="GiB">Gibibyte (GiB)</option>
        <option value="TiB">Tebibyte (TiB)</option>
      </select>

      <button type="submit">Convert</button>
    </form>

    <p id="iuc-result"><span></span></p>
  </div>
<?php
  return ob_get_clean();
}
add_shortcode('info_unit_converter', 'info_unit_converter_shortcode');

