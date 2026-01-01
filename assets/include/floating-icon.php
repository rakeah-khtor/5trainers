<?php
  // Reuse footer/header asset prefix if available so paths work from / and /blog/.
  $floatingAssetPrefix = '';
  if (isset($footerAssetPrefix)) {
    $floatingAssetPrefix = $footerAssetPrefix;
  } elseif (isset($assetPrefix)) {
    $floatingAssetPrefix = $assetPrefix;
  }
?>

<!-- Floating WhatsApp Icon with wave effect -->
<a href="https://wa.me/+918283840606" class="floating-icon whatsapp" target="_blank">
  <span class="floating-wave"></span>
  <span class="floating-wave floating-wave--delay"></span>
  <img src="<?php echo $floatingAssetPrefix; ?>assets/image/icon/whatsapp.png" alt="WhatsApp" class="floating-whatsapp">
</a>

<!-- Floating Call Icon with wave effect -->
<a href="tel:+918283840606" class="floating-icon call">
  <span class="floating-wave"></span>
  <span class="floating-wave floating-wave--delay"></span>
  <img src="<?php echo $floatingAssetPrefix; ?>assets/image/icon/call.png" alt="Call" class="floating-call">
</a>
