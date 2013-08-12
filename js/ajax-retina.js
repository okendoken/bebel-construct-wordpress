function loadRetinaImages(){
    if (Retina.isRetina()){
        jQuery('img').each(function(){
            new RetinaImage(this);
        });
    }
}

if( window.addEventListener ){
    var timeout;
    window.addEventListener( "resize", function(){
        //let's wait till resize finished
        clearTimeout(timeout);
        timeout = setTimeout(function(){
            loadRetinaImages()
        }, 500);
    }, false );
    window.addEventListener( "DOMContentLoaded", function(){
        loadRetinaImages();
        // Run once only
        window.removeEventListener( "load", loadRetinaImages, false );
    }, false );
    window.addEventListener( "load", loadRetinaImages, false );
}
else if( window.attachEvent ){
    window.attachEvent( "onload", loadRetinaImages );
}