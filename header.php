<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php if ( is_single() ) {  
   single_post_title('', true);  
   } else {  
      bloginfo('name'); echo " - "; bloginfo('description'); 
   }  
   ?>" />
<!--<meta name="description" content="Public Health Laboratory (PHL) was established in 1989 with mandate to carry out water, food drug quality testing. Water test quality was established but food and drug quality testing never received priority. PHL was given tasks to establish diagnostic capacity for infectious diseases of public health importance like tuberculosis, HIV, Hepatitis B and syphilis in 1992-1993. Gradually, infectious diseases diagnostic capacity was expanded based on the need of the country. PHL become a national reference laboratory endemic infectious disease like measles, rubella, dengue, tuberculosis during 2004-2008. PHL was identified as national reference laboratory for emerging infectious diseases in 2009, and joined the regional laboratory network on emerging infectious disease with the WHO collaborating centers and institutes in the region. PHL took up the responsibility in carrying out disease surveillance, outbreak investigation and research activities in 2010. PHL was entrusted with responsibility to establish drug quality testing by Medicine Board in 2010. Ministry of Health endorsed to change nomenclature of PHL to the Royal Centre for Disease Control in 2015 to take up more roles and responsibilities in contributing to control of important public health diseases. .." />-->
<meta name="keywords" content="Health, Surveillance, rcdc,Royal Centre for Disease Control, PHL, phls, Bhutan, Health, Public Health Laboratory, Bhutan Health Research, Disease, Control, Water Quality, NEWARS, ili, sari,govrment, National tuberculosos, tb">
<meta name="author" content="http://www.rcdc.gov.bt" />
<!--<title>RCDC |<?php //wp_title( '|', true, 'right' ); ?>
      <?php //bloginfo( 'name' ); ?></title>-->
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80366114-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript" src="inc/swobject/swfobject.js"></script>
<script type="text/javascript">
	swfobject.registerObject("myId", "9.0.0", "expressInstall.swf");
</script>
<style>
.my-list > li:first-child {
    background-color: #F5FAFA;    
}
.my-list > li:first-child:before {
   content: "NEW";
   color: red;
   font-weight: bold;
   float:right;
}
</style>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<section id="header-img">
	<div class="container">
		<div class="row nomargin">
			<div class="col-md-12">
	<img src="<?php bloginfo('template_directory');?>/img/phls.png" width="100%" valign="middle" />	
			</div>			
		</div>
	</div>	
	</section>
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse ">					
						<?php /* Primary navigation */
							wp_nav_menu( array(
							  'menu' => 'top_menu',
							  'depth' => 2,
							  'container' => false,
							  'menu_class' => 'nav navbar-nav',
							  //Process nav menu using our custom nav walker
							  'walker' => new wp_bootstrap_navwalker())
							);
						?>                   
					<!--<form class="navbar-form navbar-right">
						<?php //get_search_form(); ?><!--<input type="text" class="form-control" placeholder="Search...">--
					</form>-->
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->