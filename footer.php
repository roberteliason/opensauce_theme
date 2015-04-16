<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the MAIN div and all content after
 *
 * @package opensauce
 */
?>

		</div>

		<footer>
			<?php
				$printer = New Recipe_Print();
				echo $printer->printQRCode();
			?>
		</footer>

		<?php wp_footer(); ?>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                e.src='//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>

	</body>
</html>
