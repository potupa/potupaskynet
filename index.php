<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<title>Заголовок</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="styles.css" />
</head>
<body>
	<div class="content">
		<?
			$f_json = 'http://sknt.ru/job/frontend/data.json';
			$json = file_get_contents("$f_json");
			$obj = json_decode($json,true);
			$tariff = $obj["tarifs"];
		?>
		<div class="items tariffs">
			<? foreach ($tariff as $item) { ?>
				<div class="item tariff" data-title="<?=$item['title'];?>">
					<span class="title">
						Тариф "<?=$item["title"];?>"
					</span>
					<span class="speed">
						<?=$item["speed"];?> Мбит/с
					</span>
					<div class="price">
						<?
							$price = array();
							foreach ($item["tarifs"] as $item_tariff) {
								$price_item = $item_tariff["price"] / $item_tariff["pay_period"];
								array_push($price, $price_item);
							}
						?>
						<?=min($price)?> - <?=max($price)?> &#8381;/мес
					</div>
					<? if (isset($item["free_options"])):?>
						<div class="item-desc">
							<?foreach ($item["free_options"] as $item_options) {?>
								<p><?=$item_options;?></p>
							<?}?>
						</div>
					<?endif;?>
					<a href="<?=$item["link"]?>" class="item-link"class="item-link" target="_blank">узнать подробнее на сайте www.sknt.ru</a>
				</div>
				
			<?}?>
		</div>
		<div class="btn-back hidden">
			<span></span>
		</div>
		<div class="items">
			<? foreach ($tariff as $item) { ?>
				<?
					sort($item["tarifs"]);
					$i = 0;
					foreach ($item["tarifs"] as $item_period) {?>
					<div class="item period hidden" data-id="<?=$item_period['ID'];?>" data-title="<?=$item['title'];?>">
						<span class="title">
							<?
								$pay_period = $item_period["pay_period"];
								echo $pay_period;
							?>
							<? if ($pay_period == 1):?>
								месяц
							<?endif;?>
							<? if ($pay_period == 3):?>
								месяца
							<?endif;?>
							<? if ($pay_period == 6 || $pay_period == 12):?>
								месяцев
							<?endif;?>
						</span>
						<div class="price">
							<?=$item_period["price"] / $pay_period?> &#8381;/мес
						</div>
						<div class="item-desc">
							<p>разовый платеж - <?=$item_period["price"];?> &#8381;</p>
							<? $sale = ($item["tarifs"][0]["price"] - ($item_period["price"] / $item_period["pay_period"])) * $item_period["pay_period"];?>
							<?if ($sale != 0):?>
								<p>скидка - <?=$sale?> &#8381;</p>
							<?endif;?>
						</div>
					</div>
				<? $i++;
				}?>
				<?
					sort($item["tarifs"]);
					foreach ($item["tarifs"] as $item_period) {?>
					<div class="item detail hidden" data-id="<?=$item_period['ID'];?>">
						<span class="title">
							Тариф "<?=$item["title"];?>"
						</span>
						<div class="price">
							<p>
								<?$pay_period = $item_period["pay_period"];?>
								Период оплаты - <?=$pay_period?>
								<? if ($pay_period == 1):?>
									месяц
								<?endif;?>
								<? if ($pay_period == 3):?>
									месяца
								<?endif;?>
								<? if ($pay_period == 6 || $pay_period == 12):?>
									месяцев
								<?endif;?>
							</p>
							<p>
								<?=$item_period["price"] / $pay_period?> &#8381;/мес
							</p>
						</div>
						<div class="item-desc">
							<p>разовый платеж - <?=$item_period["price"];?> &#8381;</p>
							<p>со счета спишется - <?=$item_period["price"];?> &#8381;</p>
						</div>
						<div class="item-time">
							вступит в силу - сегодня <br>
							<?$time = date("d.m.y",$item_period["new_payday"]);?>
							активно до - <?=$time?>
						</div>
						<div class="item-bot">
							<a href="#" class="btn">Выбрать</a>
						</div>
					</div>
				<?}?>
			<?}?>
		</div>
	</div>
</body>
<script src="script.js"></script>
</html>