<?php
$list = array();
foreach ($packs as $key => $pack) {
	if (sizeof($pack->getStickers())>2) {
		$a["identifier"] = $pack->getId();
		$a["name"] = $pack->getName();
		$a["publisher"] = $pack->getPublisher();
		// A picture kept in the Space is already a finished URL: sending it through
		// the thumbnail filter would only produce a path to a file that is not there.
		$tray = $pack->getImage();
		$a["tray_image_file"] = $tray->isRemote()
			? $tray->getUrl()
			: $this['imagine']->filter($view['assets']->getUrl($tray->getLink()), 'tray_image');
		$a["publisher_email"] = $pack->getPublisheremail();
		$a["publisher_website"] = $pack->getPublisherwebsite();
		$a["privacy_policy_website"] = $pack->getPrivacypolicywebsite();
		$a["license_agreement_website"] = $pack->getLicenseagreementwebsite();
		$a["premium"] = $pack->getPremiumValue();
		$a["animated"] = $pack->getAnimatedValue();
		$a["whatsapp"] = $pack->getWhatsappValue();
		$a["telegram"] = $pack->getTelegramValue();
		$a["signal"] = $pack->getSignalValue();
		$a["signalurl"] = $pack->getSignalurl();
		$a["telegramurl"] = $pack->getTelegramurl();
		$a["review"] = $pack->getReviewValue();
		$a["trusted"] = $pack->getUser()->getTrusedValue();
		$a["downloads"] = $pack->getDownloadValue();
		$a["size"] = $pack->getSizes();
		$a["created"] = $view['time']->diff($pack->getCreated());
		$a["user"] = $pack->getUser()->getName();
		$a["userid"] = $pack->getUser()->getId() . "";
		$a["userimage"] = $pack->getUser()->getImage();
		$stickers = array();
		foreach ($pack->getStickers() as $key => $sticker) {
			$media = $sticker->getMedia();
			$host = $app->getRequest()->getSchemeAndHttpHost();
			$s["image_file"] = $media->getAbsoluteLink($host);
			// webp is already the size the app wants, and a file in the Space cannot be
			// resized by a filter that only reads this server's disk.
			$s["image_file_thum"] = ($media->getType() == "image/webp" || $media->isRemote())
				? $media->getAbsoluteLink($host)
				: $this['imagine']->filter($view['assets']->getUrl($media->getLink()), 'sticker_image_thum');
			$s["emojis"] = array($sticker->getEmojis());
			$stickers[] = $s;
		}
		$a["stickers"] = $stickers;
		$list[] = $a;
	}
}
$object["sticker_packs"] = $list;
echo json_encode($list, JSON_UNESCAPED_SLASHES);?>