<div class="wrap" style="margin-left: 20px; width: 790px;">

<h3 class="center alt">&ldquo;Construct&rdquo; Documentation by &ldquo;Bebel&rdquo; for Theme v1.0</h3>




		<h1 class="center">&ldquo;Construct&rdquo;</h1>

		<div class="borderTop">
			<div class="span-6 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
					Created: 20/10/2013<br>
					Updated: ---<br>
					By: Bebel<br>
					Email: Send us a mail through our Themeforest profile <a href="http://themeforest.net/user/Bebel">here</a>!
					</strong>
				</p>
			</div><!-- end div .span-6 -->

			<div class="span-12 last">
				<p class="prepend-top append-0">Thank you for purchasing my theme. If you have any questions that
                    are beyond the scope of this help file, please feel free to email via my user page contact
                    form <a href="http://themeforest.net/user/Bebel">here</a>. Thanks so much!</p>
			</div>
		</div><!-- end div .borderTop -->

		<hr>

		<h2 id="toc" class="alt">Table of Contents</h2>
		<ol class="alpha" style="padding-left: 30px;">
			<li><a href="#introduction">Introduction</a></li>
			<li><a href="#installation">Installation</a></li>
			<li><a href="#installed">Uploaded, Installed, What Now?</a></li>
			<li><a href="#dummy">Install Dummy Content</a></li>
            <li><a href="#slider">How to setup the Slider</a></li>
            <li><a href="#contact">Creating the Contact Page</a></li>
            <li><a href="#portfolio">Creating the Portfolio Page</a></li>
            <li><a href="#blog">Creating the Blog Page</a></li>
            <li><a href="#team">Creating the Team Page</a></li>
            <li><a href="#clients">Creating the Clients Page</a></li>
			<li><a href="#activating-mailchimp">Activating Mailchimp</a></li>
			<li><a href="#your-code">Extending and Modifying the Theme</a></li>
			<li><a href="#credits">Sources and Credits</a></li>
		</ol>

		<hr>

		<h3 id="introduction"><strong>A) Introduction</strong> - <a href="#toc">top</a></h3>
		<p>
        	Construct is a lightweight premium wordpress theme that will help your business get more attention without doing too much work.
        </p>

        <p style="font-style:italic; color: #C63">We have created some screencasts that will guide you through the theme. They are uploaded to youtube.</p>

        <p>
   			First, let me tell you some requirements of this theme.
        </p>

        <ol>
        	<li>PHP version <strong>5.1</strong> or higher.<br />This is absolute necessary.
                If your host is still running on php4, you put yourself and others in danger.
                The version 4 is officially not supported anymore. It has a lot of security issues!</li>
            <li>Wordpress version <strong>3</strong> or higher. We developped this theme for wordpress 3 and
                tested every single functionality in wordpress 3.3. It works.</li>
            <li>Mailchimp account. If you want to get the full power of this theme, you should get a mailchimp account. The free one is good enough ;)</li>
        </ol>


		<hr>

		<h3 id="installation"><strong>B) Installation</strong> - <a href="#toc">top</a></h3>

		<p>You have two ways of installing the theme. You can upload it throug the wordpress theme uploader,
            which is the most simple solution, or you can upload it via ftp.</p>

        <h4 id="installation-wordpress"><strong>The Wordpress Way</strong> - <a href="#toc">top</a></h4>

		<p>There is a great tutorial on how do to that on the wordpress site.
            <a href="https://codex.wordpress.org/Appearance_Themes_SubPanel#Using_the_upload_method">Click here to access it</a> (redirecting to wordpress.org)</p>


        <h4 id="installation-ftp"><strong>Using FTP</strong> - <a href="#toc">top</a></h4>

        <p>For this, there is a great tutorial on wordpress.org, too.
            <a href="https://codex.wordpress.org/Appearance_Themes_SubPanel#Using_the_FTP_method">Access it here</a>.</p>


        <h4 id="installation-errors"><strong>Installation Errors</strong> - <a href="#toc">top</a></h4>

		<p>If you experience any errors during the installation, please read this short section before contacting us.</p>

        <ol>
        	<li>
            	I get the error: "Unexpected T_OLD_FUNCTION" or something similar: Please upgrade to php5.1. We don't support any prior versions.<br />
                To update, refer to your host's documentation.
            </li>
            <li>
            	Wordpress tells me the stylesheet is broken.<br /> This error comes often, when you upload the files
                via ftp, but the upload somehow was not completed. Remove all the theme's files from your server and upload again.
            </li>
            <li>
            	I get the error: "Undefined function xyz".<br />As above, this is an indicator that
                either wordpress or php version is out-of-date. Please update to the most new ones!
            </li>
        </ol>


		<hr>

		<h3 id="installed"><strong>C) Uploaded. Installed. Activated. What now?</strong> - <a href="#toc">top</a></h3>

        <p style="font-style:italic; color: #C63">prolog: in this tutorial / help file, we use some links to get you
            to the relevant sections of the wordpress configuration quickly and smoothly.
            They will only work if you read this tutorial in the help section of the theme's
            configuration panel. Read below how to access it</p>

		<p>Congratulations!</p>

        <p>
        	Lets get started! First of all, go to the theme's configuration panel. After the theme activation,
            you will notice there is a new point called "Construct" beneith "Appearance" (Where you just activated the theme). <br />
            This is where all of the themes settings come together and are managed. You'll notice 2 points.
        </p>

        <ol>
			<li>Theme Configuration</li>
			<li>Help &amp; Support</li>
		</ol>

        <h4 id="theme-configuration"><strong>1) Theme Configuration</strong> - <a href="#toc">top</a></h4>

        <p>The first point, <em>Theme Configuration</em>, lets you, you might have guessed rightly, configure the
            theme's settings. We have plenty of them, but all are pretty self explanatory. </p>


        <h4 id="help-support"><strong>2) Help &amp; Support</strong> - <a href="#toc">top</a></h4>

        <p>The second point, <em>Help &amp; Support</em> contains this help file. You don't have to worry if you
            log on from another computer. You can always read this documentation in your WordPress backend.</p>



        <h3 id="dummy"><strong>D) Install Dummy Content</strong> - <a href="#toc">top</a></h3>
        <ul>
            <li>Click Tools &gt; Import</li>
            <li>Click on WordPress</li>
            <li>Install the Importer by clicking "Install Now" and then "Activate Plugin &amp; Run Importer"</li>
            <li> Upload the xml file called <strong>"constructxml.wordpress.2013-10-21.xml"</strong>, that you can find in the main folder.</li>
            <li> Now assign your posts to an existing user, check the "Download and import file attachments" checkbox and click "Submit".</li>
        </ul>

		<hr>

        <h3 id="slider"><strong>E) How to set up the Slider</strong> - <a href="#toc">top</a></h3>

        <p>This part is video only. It will teach you all the important things about the post options.
            Please watch it, as it contains several important information!</p>

        <iframe width="560" height="315" src="//www.youtube.com/embed/6F3BH6HgfB0?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>

        <hr>

        <h3 id="contact"><strong>G) Creating the Contact Page</strong> - <a href="#toc">top</a></h3>

        <p>This part is video only. It will teach you all the important things about the theme.
            Please watch it, as it contains several important information!</p>

        <iframe width="560" height="315" src="//www.youtube.com/embed/dAi3TLPPA1U?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>
        <br>

        <hr>

        <h3 id="portfolio"><strong>H) Creating the Portfolio Page</strong> - <a href="#toc">top</a></h3>
        <iframe width="560" height="315" src="//www.youtube.com/embed/CPBIMicHoPE?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>
        <br>
        <hr>

        <h3 id="blog"><strong>I) Creating the Blog Page</strong> - <a href="#toc">top</a></h3>
        <iframe width="560" height="315" src="//www.youtube.com/embed/Q0PWnrgettc?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>
        <br>
        <hr>

        <h3 id="team"><strong>J) Creating the Team Page</strong> - <a href="#toc">top</a></h3>
        <iframe width="560" height="315" src="//www.youtube.com/embed/2nyc8mU5KQU?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>
        <br>
        <hr>

        <h3 id="clients"><strong>K) Creating the Clients Page</strong> - <a href="#toc">top</a></h3>
        <iframe width="560" height="315" src="//www.youtube.com/embed/xDLFr137_ms?list=UUISL0b1_nJQijhWD34MrNrA" frameborder="0" allowfullscreen></iframe>
        <br>
        <hr>


        <h3 id="activating-mailchimp"><strong>L) Activating Mailchimp</strong> - <a href="#toc">top</a></h3>

        <p>
            What is Mailchimp?<br />
            It’s one of the best and easiest ways to send newsletter campaigns over the internet these days.
            It’s free to sign up for and very cheap even for bigger campaigns (check out there free plan, which is incredible)
        </p>

        <p>
            Follow these steps to activate and use Mailchimp with Construct Theme
        </p>
        <ol><li>Go to <a href="http://mailchimp.com" target="_blank">Mailchimp.com</a> and create an account</li>
            <li>In the Mailchimp backend menu – go to „Account Api Keys & Authorized Apps“</li>
            <li>Click on „add a key“ to create an API Key</li>
            <li>Copy that key and go back to your WP Backend.</li>
            <li>Go to your WordPress backend and to the „Theme Configuration“ within the Construct menu. Notice the new Mailchimp tab on top – click on it!</li>
            <li>You can now paste your API Key in the appropriate box and ckeck if then key is correct. Click on save changes and the big part is already done.</li>
            <li>Choose a default list from mailchimp in the field below. If you don't have a list set up yet, read below.</li>
        </ol>

        <p>You now activated Mailchimp. Congratulations! There is one more thing you have to do. You have to create
            lists in the Mailchimp backend on mailchimp.com</p>

        <ol>
            <li>Go to <a href="http://mailchimp.com" target="_blank">Mailchimp.com</a> and sign in</li>
            <li>click on „lists“ on the top navigation.</li>
            <li>Click on the big red button that says „create list“</li>
            <li>Create as many lists as you need.</li>
            <li>Go back to wordpress. You now have to tell your theme which list to use. Mailchimp integration is done :-)</li>
        </ol>


		<hr>

		<h3 id="your-code"><strong>M) Extending and Modifying the Theme</strong> - <a href="#toc">top</a></h3>

		<p>I am pretty sure you want to extend or / and modify the theme's layout and functionality to
            fit your needs. Here are a few points, you should remember when modifying any files.</p>

		<ul>
			<li>Do never modify any css file we deliver (except custom.css)</li>
			<li>Do never modify any php file we deliver (except myFunctions.php)</li>
		</ul>

		<p>Why that? Because of possible updates in the future. We do not give support for custom modified files. </p>
		<p>However, all template files (header-*.php, footer.php, comments.php and the files in the templates/ folder)
            and images can of course be modified. The restrictions are only valid for the bebel folder, and the functions.php</p>

		<h4 id="your-css"><strong>1) Custom CSS</strong> - <a href="#toc">top</a></h4>

		<p>You have several points of adding your custom CSS.</p>

		<ol>
			<li>Put the code in the Theme Configuration Panel</li>
			<li>Put the code in the custom.css inside the css folder</li>
			<li>Add CSS to every page where you need it.</li>
		</ol>

		<h5>1. Theme Configuration Panel</h5>
		<p>Simply write the css code inside the 'Custom CSS' field.</p>
		<img src="<?php echo get_stylesheet_directory_uri().BebelUtils::getBundlePath() ?>/bebelThemeBundle/help/images/extend/doc1.jpg" />

		<h5>2. css/custom.css</h5>
		<p>Paste the code into the custom.css file. The only difference to point 1. is that you can edit it in your favorite css editor.</p>


		<h5>3. Add to Post</h5>
		<p>This option should only be used if you have a css class only for one or two posts. This output won't be cached!</p>
		<img src="<?php echo get_stylesheet_directory_uri().BebelUtils::getBundlePath() ?>/bebelThemeBundle/help/images/extend/doc2.jpg" />


		<h4 id="your-php"><strong>2) Custom PHP</strong> - <a href="#toc">top</a></h4>

		<p>If you have functions you wish to add to the theme, do not paste them in the functions.php.
            Put them in "myFunctions.php". This file is included in functions.php at the very bottom to make sure
            your options override ours. </p>


		<hr>

		<h3 id="credits"><strong>N) Sources and Credits</strong> - <a href="#toc">top</a></h3>

		<p>Thanks to the following projects for making Construct possible<br />

        <ul>
            <li><a href="http://jquery.com/">jQuery</a></li>
            <li><a href="http://getbootstrap.com//">Bootstrap</a></li>
            <li><a href="http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380">Revolution Slider</a></li>
            <li><a href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a></li>
            <li><a href="http://danielbruce.se/">Entypo Glyph Set by Daniel Bruce</a></li>
            <li><a href="http://gmap3.net/">Gmap3</a></li>
            <li><a href="https://github.com/scottjehl/picturefill">picturefill</a></li>
            <li><a href="http://retinajs.com/">Retina JS</a></li>
            <li><a href="http://xoxco.com/projects/code/breakpoints">Breakpoints.js</a></li>
        </ul>

    <h3>Most images licensed from Photodone and iStock</h3>

    <h3>Other Images</h3>
    <ul>
        <li>Layered Pixels on <a href="http://themeforest.net/user/LayeredPixels" target="_blank">Themeforest</a></li>
        <li><a href="http://www.flickr.com/photos/denemiles/3970279665/in/photostream/">Dene' Miles</a></li>
        <li><a href="http://www.flickr.com/photos/denemiles/3971887734/">Dene' Miles</a></li>
	</ul>


    <h3>Fonts Used</h3>
    <ul>
		<li>Arial (Standard Font)</li>
        <li>Nobile</li>
		<li>Google Fonts <a href="http://http://www.google.com/webfonts/">here</a></li>
	</ul>

		<hr>

		<p>Once again, thank you so much for purchasing this theme. As I said at the beginning,
            I'd be glad to help you if you have any questions relating to this theme. No guarantees,
            but I'll do my best to assist. If you have a more general question relating to the themes
            on ThemeForest, you might consider visiting the forums and asking your question in the
            "Item Discussion" section.</p>

		<p class="append-bottom alt large"><strong>Bebel</strong></p>
		<p><a href="#toc">Go To Table of Contents</a></p>

		<hr class="space">
	</div><!-- end div .wrap -->
    
    