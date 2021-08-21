{combine_css path=$OPTIPIC_PATH|@cat:"admin/template/style.css"}

{footer_script}
jQuery('input[name="option2"]').change(function() {
  $('.option1').toggle();
});

jQuery(".showInfo").tipTip({
  delay: 0,
  fadeIn: 200,
  fadeOut: 200,
  maxWidth: '300px',
  defaultPosition: 'bottom'
});
{/footer_script}


<div class="titrePage">
	<h2>OptiPic</h2>
</div>

<form method="post" action="" class="properties">
<fieldset>
  <legend>{'OptiPic settings'|translate}</legend>

  <ul>
    <li>
      <label>
        <input type="checkbox" name="autoreplace_active" value="1" {if $optipic.autoreplace_active}checked="checked"{/if}>
        <b>{'Enable auto-replace image URLs'|translate}</b>
        
      </label>
    </li>
    <li class="site_id">
      <label>
        <b>{'Site ID in your personal account CDN OptiPic'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'site_id_help'|translate}"></a>
        <br>
        <input type="text" name="site_id" value="{$optipic.site_id}" size="20">
      </label>
    </li>
    <li class="domains">
      <label>
        <b>{'Domain list (if images are loaded via absolute URLs)'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'domains_help'|translate}"></a>
        <br>
        <textarea type="text" name="domains" cols="60">{$optipic.domains}</textarea>
      </label>
    </li>
    <li class="exclusions_url">
      <label>
        <b>{'Site pages that do not include auto-replace'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'exclusions_url_help'|translate}"></a>
        <br>
        <textarea type="text" name="exclusions_url" cols="60">{$optipic.exclusions_url}</textarea>
      </label>
    </li>
    <li class="whitelist_img_urls">
      <label>
        <b>{'Replace only URLs of images starting with a mask'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'whitelist_img_urls_help'|translate}"></a>
        <br>
        <textarea type="text" name="whitelist_img_urls" cols="60">{$optipic.whitelist_img_urls}</textarea>
      </label>
    </li>
    <li class="srcset_attrs">
      <label>
        <b>{'List of "srcset" attributes'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'srcset_attrs_help'|translate}"></a>
        <br>
        <textarea type="text" name="srcset_attrs" cols="60">{$optipic.srcset_attrs}</textarea>
      </label>
    </li>
    <li class="cdn_domain">
      <label>
        <b>{'CDN domain'|translate}</b>
        <a class="icon-info-circled-1 showInfo" title="{'cdn_domain_help'|translate}"></a>
        <br>
        <input type="text" name="cdn_domain" value="{$optipic.cdn_domain}" size="20">
      </label>
    </li>
  </ul>
</fieldset>

<p class="formButtons"><input type="submit" name="save_config" value="{'Save Settings'|translate}"></p>

</form>

<script type="text/javascript" src="https://optipic.io/api/cp/stat?domain={$domain}&sid={$optipic.site_id}&cms=piwigo&stype=cdn&append_to=.properties&version=1.21.0"></script>