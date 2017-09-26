<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 *
* @package    local
* @subpackage facebook
* @copyright  2017 Jorge Cabané (jcabane@alumnos.uai.cl)
* @copyright  2017 Joaquin Rivano (jrivano@alumnos.uai.cl)
* @copyright  2017 Javier Gonzalez (javiergonzalez@alumnos.uai.cl)
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

/*highlight_string("<?php\n\$data =\n" . var_export($resources, true) . ";\n?>");*/
require_once (dirname ( dirname ( dirname ( dirname ( __FILE__ ) ) ) ) . '/config.php');
require_once ($CFG->dirroot . '/local/facebook/locallib.php');
require_once ($CFG->dirroot . "/local/facebook/app/Facebook/autoload.php");
global $DB, $USER, $CFG, $OUTPUT;
/*use Facebook\FacebookResponse;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequire;
use Facebook\Request;*/
$courses = enrol_get_users_courses($USER->id);
$notice = facebook_notificationspercourse($USER, $courses);
$last = facebook_isthisfirsttime($USER->id)->lasttimechecked;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/materialize.min.css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/jquerytour.css" />
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('.footer');
		</script>
<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

</head>
<body>

	<!-- here start the fixed NavBar -->
	<header>
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper teal darken-3">
					<a href="#" class="brand-logo center"><h2 class="tour_1">WebC</h2></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<?php 
						if($notice[0] == 0){
							echo "<li id='cursosli'><a class='tour_3'><Cursos</a></li>";
						}
						else{
							echo "<li id='cursosli'><a class='tour_3'>Cursos
 		 						  <span class='new badge light-blue darken-'>".$notice[0]."</span></a></li>";
						}
								?>
 		<li><a href=""><i class="material-icons right">home</i>Webcursos</a></li> 
					</ul>

					<ul>
						<li><a href="http://webcursos-d.uai.cl/local/facebook/connect.php" target="_blank">Cuenta</a></li>
						<li><a href="<?php echo $CFG->fbk_tutorialurl;?>" target="_blank"><?php echo $CFG->fbk_tutorialsname;?></a></li>
						<li><a href="http://webcursos.uai.cl/local/tutoriales/faq.php" target="_blank">Privacidad</a></li>
						<li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enviar mail a contacto" 
						       href="mailto:<?php echo $CFG->fbk_email;?>" >Contacto</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	<!-- here Start the Popout collapsible -->


	<ul class="collapsible popout" data-collapsible="accordion">
		<!-- first row of the collapsible with the info cards -->
		<li class="hidecursosactuales">
			<div class="collapsible-header active">
				<i class="material-icons">notifications</i><h2 class="tour_2">Noticias</h2>
			</div>
			<div class="collapsible-body">

				<div class="row" style="height: 100%;">
					<!-- first card with info -->
					<div class="col s12 m6 l3" >
						<div class="card sticky-action z-depth-4 hoverable ">
							<div class="card-image waves-effect waves-block waves-light">
								<div class="row center-align">
									<i class="large material-icons activator"><?php echo $CFG->fbk_card1icon;?></i>
								</div>

							</div>
							<div class="card-content">
								<div class="right-align">
									<i class="material-icons right">more_vert</i>
								</div>
								<div class="row center-align">
									<span class="card-title activator grey-text text-darken-4"><?php echo $CFG->fbk_card1title;?> </span>
								</div>
								<p class="truncate"><?php echo $CFG->fbk_card1text;?></p>
							</div>

							<div class="card-action">
								<a class="waves-effect waves-light btn" href="<?php echo $CFG->fbk_card1link;?>" target="_blank"">More About</a>
							</div>

							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?php echo $CFG->fbk_card1title;?><i
									class="material-icons right">close</i></i></span>
								<p><?php echo $CFG->fbk_card1text;?></p>
							</div>
						</div>
					</div>
					<!-- second card with info -->
					<div class="col s12 m6 l3" >
						<div class="card sticky-action z-depth-4 hoverable">
							<div class="card-image waves-effect waves-block waves-light">
								<div class="row center-align">
									<i class="large material-icons center-align activator"><?php echo $CFG->fbk_card2icon;?></i>
								</div>
							</div>
							<div class="card-content">
								<div class="right-align">
									<i class="material-icons right">more_vert</i>
								</div>
								<span class="card-title activator grey-text text-darken-4"><?php echo $CFG->fbk_card2title;?> </span>

								<p class="truncate"><?php echo $CFG->fbk_card2text;?></p>
							</div>

							<div class="card-action">
								<a class="waves-effect waves-light btn" href="<?php echo $CFG->fbk_card2link;?>" target="_blank">More About</a>
							</div>

							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?php echo $CFG->fbk_card2title;?><i
									class="material-icons right">close</i></i></span>
								<p><?php echo $CFG->fbk_card2text;?></p>
							</div>
						</div>
					</div>
					<!-- third card with info -->
					<div class="col s12 m6 l3">
						<div class="card sticky-action z-depth-4 hoverable">
							<div class="card-image waves-effect waves-block waves-light">
								<div class="row center-align">
									<i class="large material-icons center-align activator"><?php echo $CFG->fbk_card3icon;?></i>
								</div>
							</div>
							<div class="card-content">
								<div class="right-align">
									<i class="material-icons right">more_vert</i>
								</div>
								<span class="card-title activator grey-text text-darken-4"><?php echo $CFG->fbk_card3title;?></span>

								<p class="truncate"><?php echo $CFG->fbk_card3text;?></p>
							</div>

							<div class="card-action">
								<a class="waves-effect waves-light btn" href="<?php echo $CFG->fbk_card3link;?>" target="_blank">More About</a>
							</div>

							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?php echo $CFG->fbk_card3title;?><i
									class="material-icons right">close</i></i></span>
								<p><?php echo $CFG->fbk_card3text;?></p>
							</div>
						</div>
					</div>
					<!-- fourth card with info -->
					<div class="col s12 m6 l3">
						<div class="card sticky-action z-depth-4 hoverable"">
							<div class="card-image waves-effect waves-block waves-light">
								<div class="row center-align">
									<i class="large material-icons center-align activator"><?php echo $CFG->fbk_card4icon;?></i>
								</div>

							</div>
							<div class="card-content">
								<div class="right-align">
									<i class="material-icons right">more_vert</i>
								</div>
								<div class="row center-align">
									<span class="card-title activator black-text text-darken-4"><?php echo $CFG->fbk_card4title;?></span>
								</div>
								<p class="truncate"><?php echo $CFG->fbk_card4text;?></p>
							</div>

							<div class="card-action">
								<div class="row center-align">
									<a class="waves-effect waves-light btn" href="<?php echo $CFG->fbk_card4link;?>" target="_blank">More About</a>
								</div>
							</div>

							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?php echo $CFG->fbk_card4title;?><i
									class="material-icons right">close</i></i></span>
								<p><?php echo $CFG->fbk_card4text;?></p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</li>
		<!-- second row of the collapsible with the actual courses -->
		<li>
			<div class="collapsible-header" id="cursosactual">
				<i class="material-icons">school</i><h2 class="tour_4">Semestre Actual</h2>
			</div>
			<div class="collapsible-body">
				<div class="row loadcursosactuales"></div>
					<?php include_once "cursosactuales.php";?>
				</div>
		</li>
		<!-- third row of the collapsible with the manual enrol courses -->
		<li class="hidecursosactuales">
			<div class="collapsible-header">
				<i class="material-icons">add_box</i><h2 class="tour_5">Cursos Adicionales</h2>
			</div>
			<div class="collapsible-body">
				<div class="row"></div>
					<?php include_once "cursosadicionales.php";?>
				</div>
		</li>
<!--  -->
	<li class="hidecursosactuales">
			<div class="collapsible-header">
				<i class="material-icons">add_box</i><h2 class="tour_6">Cursos Generales</h2>
			</div>
			<div class="collapsible-body">
				<div class="row"></div>
					<?php include_once "cursosmeta.php";?>
				</div>
		</li>
<!--  -->		

	</ul>

	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script> 
$(document).ready(function(){
    $('.collapsible').collapsible();
 });
</script>
	<script> 
$(document).ready(function(){
	$( "#cursosli" ).click(function() {
		$('#cursosactual').click();
	});
});
	</script>
	
<script>
$( document ).ready(function() {
	$( ".curso" ).click(function() {
		var moodleidvar = $(this).attr("moodleid");
		var courseidvar = $(this).attr("courseid");
		$( ".cursosactuales" ).hide();
		$( ".hidecursosactuales" ).hide();
		$( ".loadcursosactuales" ).load( "coursetable.php" , {moodleid:moodleidvar, courseid:courseidvar});
	});
});
</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
	
$( document ).ready(function() {
	var lasttime = <?php echo $last ?>;
	if (lasttime == 0){

		$(function() {
			var config = [
				{
					"name" 		: "tour_1",
					"bgcolor"	: "black",
					"color"		: "white",
					"position"	: "TL",
					"text"		: "Bienvenido a WebCursos app",
					"time" 		: 5000
				},
				{
					"name" 		: "tour_2",
					"bgcolor"	: "black",
					"color"		: "white",
					"text"		: "Acá podrá ver noticias, su calendario, proximos eventos, contactar soporte y hacer preguntas.",
					"position"	: "TL",
					"time" 		: 5000
				},
				{
					"name" 		: "tour_3",
					"bgcolor"	: "black",
					"color"		: "white",
					"text"		: "Haciendo click aquí podrá ver sus cursos, además se le notificará si hay notificaciones nuevas",
					"position"	: "R",
					"time" 		: 5000
				},
				{
					"name" 		: "tour_4",
					"bgcolor"	: "black",
					"color"		: "white",
					"text"		: "Estos son los cursos en los que Ud. fue inscrito. Si hay notificaciones nuevas de cada curso, aparecerá un número con las cosas nuevas",
					"position"	: "TL",
					"time" 		: 5000
				},
				{
					"name" 		: "tour_5",
					"bgcolor"	: "black",
					"color"		: "white",
					"text"		: "Estos son los cursos donde Ud. se automatriculó.",
					"position"	: "TL",
					"time" 		: 5000
				},
				{
					"name" 		: "tour_6",
					"bgcolor"	: "black",
					"color"		: "white",
					"text"		: "Estos son los cursos generales. Haciendo click en los cursos será redirigido a una nueva página del respectivo curso",
					"position"	: "BL",
					"time" 		: 5000
				},
			],
	
			autoplay	= false,
			showtime,
			step		= 0,
			total_steps	= config.length;			
			showControls();
			
			$('#activatetour').live('click',startTour);
			$('#canceltour').live('click',endTour);
			$('#endtour').live('click',endTour);
			$('#restarttour').live('click',restartTour);
			$('#nextstep').live('click',nextStep);
			$('#prevstep').live('click',prevStep);
				
			function startTour(){
				$('#activatetour').remove();
				$('#endtour,#restarttour').show();
				if(!autoplay && total_steps > 1)
					$('#nextstep').show();
				showOverlay();
				nextStep();
			}
				
			function nextStep(){
				if(!autoplay){
					if(step > 0)
						$('#prevstep').show();
					else
						$('#prevstep').hide();
					if(step == total_steps-1)
						$('#nextstep').hide();
					else
						$('#nextstep').show();	
				}	
				if(step >= total_steps){
					//if last step then end tour
					endTour();
					return false;
				}
				++step;
				showTooltip();
			}
		
			function prevStep(){
				if(!autoplay){
					if(step > 2)
						$('#prevstep').show();
					else
						$('#prevstep').hide();
					if(step == total_steps)
						$('#nextstep').show();
				}		
				if(step <= 1)
					return false;
				--step;
				showTooltip();
			}
			
			function endTour(){
				step = 0;
				if(autoplay) clearTimeout(showtime);
				removeTooltip();
				hideControls();
				hideOverlay();
			}
			
			function restartTour(){
				step = 0;
				if(autoplay) clearTimeout(showtime);
				nextStep();
			}
			
			function showTooltip(){

				removeTooltip();
				
				var step_config		= config[step-1];
				var $elem			= $('.' + step_config.name);
				
				if(autoplay)
					showtime	= setTimeout(nextStep,step_config.time);
				
				var bgcolor 		= step_config.bgcolor;
				var color	 		= step_config.color;
				
				var $tooltip		= $('<div>',{
					id			: 'tour_tooltip',
					className 	: 'tooltip',
					html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
				}).css({
					'display'			: 'none',
					'background-color'	: bgcolor,
					'color'				: color
				});
				
				//position the tooltip correctly:
				
				//the css properties the tooltip should have
				var properties		= {};
				
				var tip_position 	= step_config.position;
				
			//append the tooltip but hide it
				$('BODY').prepend($tooltip);
				
				//get some info of the element
				var e_w				= $elem.outerWidth();
				var e_h				= $elem.outerHeight();
				var e_l				= $elem.offset().left;
				var e_t				= $elem.offset().top;
				
				
				switch(tip_position){
				//	TL BL R
				case 'TL'	:
					properties = {
						'left'	: e_l,
						'top'	: e_t + e_h + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
					break;
				case 'TR'	:
					properties = {
						'left'	: e_l + e_w - $tooltip.width() + 'px',
						'top'	: e_t + e_h + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
					break;
				case 'BL'	:
					properties = {
						'left'	: e_l + 'px',
						'top'	: e_t - $tooltip.height() + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
					break;
				case 'BR'	:
					properties = {
						'left'	: e_l + e_w - $tooltip.width() + 'px',
						'top'	: e_t - $tooltip.height() + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
					break;
				case 'LT'	:
					properties = {
						'left'	: e_l + e_w + 'px',
						'top'	: e_t + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
					break;
				case 'LB'	:
					properties = {
						'left'	: e_l + e_w + 'px',
						'top'	: e_t + e_h - $tooltip.height() + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
					break;
				case 'RT'	:
					properties = {
						'left'	: e_l - $tooltip.width() + 'px',
						'top'	: e_t + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
					break;
				case 'RB'	:
					properties = {
						'left'	: e_l - $tooltip.width() + 'px',
						'top'	: e_t + e_h - $tooltip.height() + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
					break;
				case 'T'	:
					properties = {
						'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
						'top'	: e_t + e_h + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
					break;
				case 'R'	:
					properties = {
						'left'	: e_l - $tooltip.width() + 'px',
						'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
					break;
				case 'B'	:
					properties = {
						'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
						'top'	: e_t - $tooltip.height() + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
					break;
				case 'L'	:
					properties = {
						'left'	: e_l + e_w  + 'px',
						'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
					};
					$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
					break;
			}
				var w_t	= $(window).scrollTop();
				var w_b = $(window).scrollTop() + $(window).height();
				//get the boundaries of the element + tooltip
				var b_t = parseFloat(properties.top,10);
				
				if(e_t < b_t)
					b_t = e_t;
				
				var b_b = parseFloat(properties.top,10) + $tooltip.height();
				if((e_t + e_h) > b_b)
					b_b = e_t + e_h;
					
					
				if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
					$('html, body').stop()
					.animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
						//need to reset the timeout because of the animation delay
						if(autoplay){
							clearTimeout(showtime);
							showtime = setTimeout(nextStep,step_config.time);
						}
						$tooltip.css(properties).show();
					});
				}
				else
					$tooltip.css(properties).show();
			}
			
			function removeTooltip(){
				$('#tour_tooltip').remove();
			}
			
			function showControls(){
				//Navigate the tour
				var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols">';
				$tourcontrols += '<p>First time here?</p>';
				$tourcontrols += '<span class="button" id="activatetour">Start the tour</span>';
					if(!autoplay){
						$tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
						$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
					}
					$tourcontrols += '<a id="restarttour" style="display:none;">Restart the tour</span>';
					$tourcontrols += '<a id="endtour" style="display:none;">End the tour</a>';
					$tourcontrols += '<span class="close" id="canceltour"></span>';
					$tourcontrols += '</div>';
				
				$('BODY').prepend($tourcontrols);
				$('#tourcontrols').animate({'right':'30px', 'top':'500px'},500);
			}
			
			function hideControls(){
				$('#tourcontrols').remove();
			}
			
			function showOverlay(){
				var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
				$('BODY').prepend($overlay);
			}
			
			function hideOverlay(){
				$('#tour_overlay').remove();
			}
			
		});
	}
});
</script>
</body>
</html>