<ul>
    <?php // AMAZON 
    if ($mm_isbn) { ?>
    <li><a title="Buy <?php echo $booktitle; ?> at Amazon" target="_blank" href="http://www.amazon.com/gp/search?keywords=<?php echo $mm_isbn;?>&index=books&linkCode=qs&tag=jk-website-20"><img src="<?php echo $imgpath; ?>amazon.png" /></a></li>
    <?php } // end AMAZON ?>

    <?php // KINDLE
    if (get_post_meta($post->ID, "asin", true)) {
        $mm_asin = get_post_meta($post->ID, "asin", true); ?>
        <li><a title="Buy <?php echo $booktitle; ?> for the Kindle" target="_blank" href="http://www.amazon.com/dp/<?php echo $mm_asin;?>/&tag=jk-website-20"><img src="<?php echo $imgpath; ?>kindle.jpg" /></a></li>
    <?php } //end KINDLE ?>

    <?php // B&N
      if ($mm_isbn) { 
        $URL = "http://www.barnesandnoble.com/s/" . $mm_isbn; ?>
    <li><a title="Buy <?php echo $booktitle; ?> at Barnes &amp; Noble" target="_blank" href="<?php echo $data; ?>"><img src="<?php echo $imgpath; ?>barnes-and-noble.png" /></a></li>
    <?php } // end B&N ?>
    <?php // NOOK ISBN
    if (get_post_meta($post->ID, "nook_isbn", true)) {
        $mm_nook_isbn = get_post_meta($post->ID, "nook_isbn", true);
        $URL = "http://www.barnesandnoble.com/s/" . $mm_nook_isbn; ?>
    <li><a title="Buy <?php echo $booktitle; ?> for the Nook" target="_blank" href="<?php echo $data;?>"><img src="<?php echo $imgpath; ?>nook.jpg" /></a></li>
    <?php }  
    //end NOOK ?>
    
    <?php // B&N
   /*   if ($mm_isbn) { 
        $URL = "http://getdeeplink.linksynergy.com/createcustomlink.shtml?token=317c4d73f09a819effbb70e6ee27d25fbdd96239692f98cde8cdeac6ccbb1e11&mid=36889&murl=http://search.barnesandnoble.com/booksearch/isbninquiry.asp?ean=" . $mm_isbn;
        //Initialize the Curl session 
        $ch = curl_init(); 
        //Set curl to return the data instead of printing it to the browser. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //Set the URL 
        curl_setopt($ch, CURLOPT_URL, $URL); 
        //Execute the fetch 
        $data = curl_exec($ch); 
        //Close the connection 
        curl_close($ch);
        //$bn_link = file_get_contents("http://getdeeplink.linksynergy.com/createcustomlink.shtml?token=317c4d73f09a819effbb70e6ee27d25fbdd96239692f98cde8cdeac6ccbb1e11&mid=36889&murl=http://search.barnesandnoble.com/booksearch/isbninquiry.asp?ean=" . $mm_isbn); ?>
    <li><a title="Buy <?php echo $booktitle; ?> at Barnes & Noble" target="_blank" href="<?php echo $data; ?>"><img src="<?php echo $imgpath; ?>barnes-and-noble.png" /></a></li>
    <?php } // end B&N ?>
    <?php // NOOK ISBN
    if (get_post_meta($post->ID, "nook_isbn", true)) {
        $mm_nook_isbn = get_post_meta($post->ID, "nook_isbn", true);
        $URL = "http://getdeeplink.linksynergy.com/createcustomlink.shtml?token=317c4d73f09a819effbb70e6ee27d25fbdd96239692f98cde8cdeac6ccbb1e11&mid=36889&murl=http://search.barnesandnoble.com/booksearch/isbninquiry.asp?ean=" . $mm_nook_isbn;
        //Initialize the Curl session 
        $ch = curl_init(); 
        //Set curl to return the data instead of printing it to the browser. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //Set the URL 
        curl_setopt($ch, CURLOPT_URL, $URL); 
        //Execute the fetch 
        $data = curl_exec($ch); 
        //Close the connection 
        curl_close($ch);
        //$bn_nook_link = file_get_contents("http://getdeeplink.linksynergy.com/createcustomlink.shtml?token=317c4d73f09a819effbb70e6ee27d25fbdd96239692f98cde8cdeac6ccbb1e11&mid=36889&murl=http://search.barnesandnoble.com/booksearch/isbninquiry.asp?ean=" . $mm_nook_isbn); ?>
    <li><a title="Buy <?php echo $booktitle; ?> for the Nook" target="_blank" href="<?php echo $data;?>"><img src="<?php echo $imgpath; ?>nook.jpg" /></a></li>
    <?php } */ 
    //end NOOK ?>

    <?php 
     if ($mm_isbn) { ?>

     <!-- INDIE BOUND -->
    <li><a title="Buy <?php echo $booktitle; ?> at IndieBound" target="_blank" href="http://www.indiebound.org/book/<?php echo $mm_isbn;?>"><img src="<?php echo $imgpath; ?>indie-bound.png" /></a></li>

    <!-- ITUNES -->
    <li><a title="Buy <?php echo $booktitle; ?> on iTunes" target="_blank" href="http://itunes.apple.com/us/book/isbn<?php echo $stripped_isbn;?>"><img src="<?php echo $imgpath; ?>itunes-logo.jpg" /></a></li>
     
     <!--  GOOGLE -->
    <li><a title="Buy <?php echo $booktitle; ?> on Google Books" target="_blank" href="http://books.google.com/books?vid=ISBN<?php echo $stripped_isbn;?>"><img src="<?php echo $imgpath; ?>logo-google.png" /></a></li>

    <!--  BAM -->
    <li><a title="Buy <?php echo $booktitle; ?> at Books-a-Million" target="_blank" href="http://www.booksamillion.com/search?id=4571990751298&query=<?php echo $mm_isbn;?>&where=All&search.x=0&search.y=0&search=Search"><img src="<?php echo $imgpath; ?>bamm-books-a-million.png" /></a></li>
    
    <!--  POWELLS -->
    <li><a title="Buy <?php echo $booktitle; ?> at Powell's Books" target="_blank" href="http://www.powells.com/biblio?isbn=<?php echo $mm_isbn;?>"><img src="<?php echo $imgpath; ?>powells-books.png" /></a></li>

    
    <?php } // end isbn ?>
     
    <!-- KOBO -->
    <li><a href="http://www.kobobooks.com/search/search.html?q=jeff+abbott" target="_blank" title="Buy <?php echo $booktitle; ?> on Kobo"><img src="<?php echo $imgpath; ?>kobo.png" /></a></li>
    
</ul>