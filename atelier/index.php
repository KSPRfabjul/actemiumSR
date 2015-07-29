<?php
include '../lib/includes.php';

$message = '';

$date = date("Y-m-d");

$date = $db->quote($date);
$select = $db->query("SELECT * FROM accueil WHERE date=$date");
$message = $select->fetch();

include './includes/header.php';
?>

<!-- row -->
<div class="row">
	<div class="col-lg-10">
		<marquee direction="left" scrollamount="3" class="marquee"><?= $message['value']; ?></marquee>
	</div>
	<div class="col-lg-2">
		<iframe src="http://www.zeitverschiebung.net/clock-widget-iframe?language=fr&timezone=Europe%2FParis" width="100%" height="130" frameborder="0" seamless></iframe>
	</div>
</div>
<!-- /row -->

<!-- row -->
<div class="row">
	<div class="col-lg-9">
		<div id="myCarousel" class="carousel-main slide" data-ride="carousel">

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
					//nom du répertoire contenant les images à afficher
					$nom_repertoire = '../ecran_accueil/img/pres';

					//on ouvre le repertoire
					$pointeur = opendir($nom_repertoire);
					$i = 0;

					//on les stocke les noms des fichiers des images trouvées, dans un tableau
					while ($fichier = readdir($pointeur)){
						if (substr($fichier, -3) == "gif" || substr($fichier, -3) == "jpg" || substr($fichier, -3) == "png" 
						|| substr($fichier, -4) == "jpeg" || substr($fichier, -3) == "PNG" || substr($fichier, -3) == "GIF" 
						|| substr($fichier, -3) == "JPG"){
							$tab_image[$i] = $fichier;
							$i++;      
						}
					}

					//on ferme le répertoire
					closedir($pointeur);

					//on trie le tableau par ordre alphabétique
					array_multisort($tab_image, SORT_ASC);

					//affichage de la première image
					$image = '<img class="center-block img-carousel pres" src="'.$nom_repertoire.'/'.$tab_image[0].'" alt="">';

					echo '
					<div class="item active">
					'.$image.'
					</div>
					';

					//affichage des images
					for ($j=1;$j<=$i-1;$j++){
						$image = '<img class="center-block img-carousel pres" src="'.$nom_repertoire.'/'.$tab_image[$j].'" alt="">';

						echo
						'
						<div class="item">
						'.$image.'
						</div>
						';
					}
				?>
			</div>

		</div>
	</div>
	<div class="col-lg-3" style="padding-left: 0;">
		<div class="row">
			<div style="width:350px; height:250px;">
			    <object type="application/x-shockwave-flash" data="http://swf.yowindow.com/yowidget3.swf" width="400" height="250">
			    	<param name="movie" value="http://swf.yowindow.com/yowidget3.swf"/>
			    	<param name="allowfullscreen" value="true"/>
			    	<param name="wmode" value="opaque"/>
			    	<param name="bgcolor" value="#FFFFFF"/>
			    	<param name="flashvars" 
			    	value="location_id=gn:2977214&amp;location_name=Saint-R%C3%A9my-de-Provence&amp;time_format=24&amp;unit_system=metric&amp;lang=fr&amp;background=#FFFFFF&amp;mini_action=window&amp;copyright_bar=false"
			    />
			    </object>
			</div>
		</div>
		<div class="row" style="margin-top: 10px;">
			<!-- start feedwind code -->
			<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://www.bfmtv.com/rss/dix-infos-eco.rss",rssmikle_frame_width: "370",rssmikle_frame_height: "350",frame_height_by_article: "0",rssmikle_target: "_blank",rssmikle_font: "Arial, Helvetica, sans-serif",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "off",autoscroll: "on_mc",scrolldirection: "up",scrollstep: "4",mcspeed: "40",sort: "New",rssmikle_title: "on",rssmikle_title_sentence: "",rssmikle_title_link: "",rssmikle_title_bgcolor: "#014188",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "200",rssmikle_item_title_color: "#014188",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "500",rssmikle_item_description_color: "#666666",rssmikle_item_date: "on",rssmikle_timezone: "Europe/Paris",datetime_format: "%e.%m.%Y %k:%M:%S",item_description_style: "text",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; width:450px;"><a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a><!--Please display the above link in your web page according to Terms of Service.--></div>
			<!-- end feedwind code -->
		</div>
	</div>
</div>
<!-- /row -->

<?php
include './includes/footer.php';
?>
            
