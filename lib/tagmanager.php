<?php
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

class TagManager {
	function AddSiteTagmanager(&$content){
		global $APPLICATION;
		$gtm_id = Option::get("prinum.gtmgo", "gtm_id", "");
		$go_id = Option::get("prinum.gtmgo", "go_id", "");	

		if (!empty($go_id)){
			Asset::getInstance()->addString("<style>.async-hide { opacity: 0 !important} </style>
			<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
			h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
			(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
			})(window,document.documentElement,'async-hide','dataLayer',1000,
			{'".$go_id."':true});</script>", true);
		}		

		if (!empty($gtm_id)){
			Asset::getInstance()->addString("<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl+ '&gtm_auth=zhzTRlfdyjpZ2jpP8hyt4A&gtm_preview=env-2&gtm_cookies_win=x';f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','".$gtm_id."');</script>", true);

			$frame_gtm = "<!-- Google Tag Manager (noscript) --><noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=".$gtm_id."&gtm_auth=zhzTRlfdyjpZ2jpP8hyt4A&gtm_preview=env-2&gtm_cookies_win=x\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->";

			$content = preg_replace("@<body>@uis", "<body>".$frame_gtm, $content);			
		}

		return true;
	}  
}
