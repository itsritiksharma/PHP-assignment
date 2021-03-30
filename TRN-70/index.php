<?php
	include 'ApiFetch.php';
	use ComposerNew\apifetch as ApiFetch;
	$url = 'https://www.innoraft.com/';
	$response = new ApiFetch();
	$actual_content = $response->getcontent($url);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>apifetch</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class='container'>
        <div class='header'>
          <p>Innoraft has been successfully delivering web and mobile solutions to esteemed global clientele. Our key solutions include website design and development, Drupal development and maintenance, mobile app design and development, and E-Commerce solutions. The quality-driven processes for all these services is our USP and we live by them every single day. We love to work with startups, small, medium, and large scale enterprises in the same way i.e. as partners</p>
        </div>
        <div class='row'>
          <div class='image'>
            <?php echo $actual_content[0][2];?>
          </div>
          <div class="service-rv--content">
            <div class="main_content">
              <?php echo $actual_content[0][0];?>
              <div class="service-icon">
                <?php for($i=0;$i<count($actual_content[0][3]);$i++){
                	echo $actual_content[0][3][$i];
                }?>
              </div>
              <div class="service-list">
                <?php echo $actual_content[0][1];?>
              </div>
              <div class="cta-link">
                <a class="btn" href="/services/web-design-development">Explore More</a>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='image'>
            <?php echo $actual_content[1][2];?>
          </div>
          <div class="service-rv--content">
            <div class="main_content">
              <?php echo $actual_content[1][0];?>
              <div class="service-icon">
                <?php for($i=0;$i<count($actual_content[1][3]);$i++){
                	echo $actual_content[1][3][$i];
                }?>
              </div>
              <div class="service-list">
                <?php echo $actual_content[1][1];?>
              </div>
              <div class="cta-link">
                <a class="btn" href="/services/web-design-development">Explore More</a>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='image'>
            <?php echo $actual_content[2][2];?>
          </div>
          <div class="service-rv--content">
            <div class="main_content">
              <?php echo $actual_content[2][0];?>
              <div class="service-icon">
                <?php for($i=0;$i<count($actual_content[2][3]);$i++){
                	echo $actual_content[2][3][$i];
                }?>
              </div>
              <div class="service-list">
                <?php echo $actual_content[2][1];?>
              </div>
              <div class="cta-link">
                <a class="btn" href="/services/web-design-development">Explore More</a>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='image'>
            <?php echo $actual_content[3][2];?>
          </div>
          <div class="service-rv--content">
            <div class="main_content">
              <?php echo $actual_content[3][0];?>
              <div class="service-icon">
                <?php for($i=0;$i<count($actual_content[3][3]);$i++){
                	echo $actual_content[3][3][$i];
                }?>
              </div>
              <div class="service-list">
                <?php echo $actual_content[3][1];?>
              </div>
              <div class="cta-link">
                <a class="btn" href="/services/web-design-development">Explore More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
	</body>
</html>
