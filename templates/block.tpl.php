<script type="text/x-nemid" id="nemid_parameters"><?php echo $params;?></script>
<script>
 function onNemIDMessage(e) {
     var event = e || event;

     var win = document.getElementById("nemid_iframe").contentWindow, postMessage = {}, message;
     message = JSON.parse(event.data);

     if (message.command === "SendParameters") {
         var htmlParameters = document.getElementById("nemid_parameters").innerHTML;

         postMessage.command = "parameters";
         postMessage.content = htmlParameters;
         win.postMessage(JSON.stringify(postMessage), "<?php echo $settings['danid_baseurl'];?>");
     }

     if (message.command === "changeResponseAndSubmit") {
         document.postBackForm.response.value = message.content;
         document.postBackForm.submit();
     }
 }

 if (window.addEventListener) {
     window.addEventListener("message", onNemIDMessage);
 } else if (window.attachEvent) {
     window.attachEvent("onmessage", onNemIDMessage);
 }
</script>
<?php
  echo drupal_nemid_login_get_block_tab_ul();
?>

<?php
if (!isset($_SESSION['nemid_login']['errors'])) {
  $returnUrl = 'nemid_sg/verify';
  echo drupal_nemid_login_get_block_tab_content($settings, $returnUrl);
}
else
{
  print_r($_SESSION['nemid_login']['errors']);
  echo t("There was a problem the NemID client");
}
?>
