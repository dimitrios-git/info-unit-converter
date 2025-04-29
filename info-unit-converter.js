jQuery(document).ready(function($) {
  $('#iuc-form').on('submit', function(e) {
    e.preventDefault();

    const nonce = $('#iuc_nonce_field').val();
    if (!nonce) {
      alert('Security error: Missing nonce.');
      return;
    }

    const inputValue = parseFloat($('#iuc-input-value').val());
    const inputUnit = $('#iuc-from-unit').val();
    const outputUnit = $('#iuc-to-unit').val();
    const $result = $('#iuc-result span');

    let output;

    try {
      if (isNaN(inputValue)) {
        throw new Error('Please enter a valid number.');
      }

      const conversionRates = {
        // SI
        'bit': 1,
        'byte': 8,
        'kB': 8 * 1000,
        'MB': 8 * 1000000,
        'GB': 8 * 1000000000,
        'TB': 8 * 1000000000000,

        // IEC
        'KiB': 8 * 1024,
        'MiB': 8 * 1024 ** 2,
        'GiB': 8 * 1024 ** 3,
        'TiB': 8 * 1024 ** 4
      };

      if (!conversionRates[inputUnit] || !conversionRates[outputUnit]) {
        throw new Error('Unsupported unit selected.');
      }

      const valueInBits = inputValue * conversionRates[inputUnit];
      const convertedValue = valueInBits / conversionRates[outputUnit];

      output = `Result: ${convertedValue.toFixed(2)} ${outputUnit}`;
      $result.removeClass('iuc-error').addClass('iuc-success');
    } catch (err) {
      output = `Error: ${err.message}`;
      $result.removeClass('iuc-success').addClass('iuc-error');
    }

    $result.text(output);
  });
});

