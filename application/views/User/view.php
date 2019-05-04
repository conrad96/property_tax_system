<?php //print_r($property); ?>
<?php foreach($property as $prop): 

		$all_data = json_decode($prop->data);
?>

<div>
	<div class="header">
		<h1 style="text-align: center;">KIRA MUNICIPAL COUNCIL</h1>
		<section>
			<ul class="pull-left" style="list-style: none;">
				<li>P.O Box 25749</li>
				<li>Kampala</li>
				<li>TIN No. 1000151480</li>
			</ul>
		</section>
		<span>
			<!-- display first photo -->
			<?php 

			if(!empty($all_data->photos->images)):
				$data = $all_data->photos->images;

				print  "<img src='".base_url()."assets/uploads/property_images/".$data[0]."' style='width: 80px;height: 75px;' />";
			endif;
			?>
		</span>
		<center><h3>
			<?php echo $prop->title; ?>
		</h3>
		</center>
	</div>
</div>

<?php endforeach; ?>
