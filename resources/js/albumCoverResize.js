


window.onload = function(){
    var width = document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-img').clientWidth;
    document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-cd').style.height = width+'px';
    document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-cd').style.width = width+'px';
    if (window.innerWidth<992) {

        document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-text').style.width = width+'px';
    }
    window.onresize = function() {

        // var maxwidth = document.querySelector('body#shop #app section.hero .hero-img').style.maxWidth
        // var maxHeight = document.querySelector('body#shop #app section.hero .hero-img').style.maxHeight
        var width = document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-img').clientWidth;
        document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-cd').style.height = width+'px';
        document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-cd').style.width = width+'px';
        if (window.innerWidth<992) {

            document.querySelector('body#shop #app section.hero .hero-cd-text-wrapper .hero-text').style.width = width+'px';
        }

    }
    albumSlideAnimation()
    window.onresize = function() {
        albumSlideAnimation()
        
    }
}


function albumSlideAnimation() {
    if (window.innerWidth>=992) {

        var bsDiv = document.querySelector(".hover-message.show");
        var x, y;
        document.querySelector(".hero-cd").addEventListener('mousemove', function(event){
            x = event.clientX + 20;
            y = event.clientY - 5;                    
            if ( typeof x !== 'undefined' ){
                bsDiv.style.left = x + "px";
                bsDiv.style.top = y + "px";
            }
        }, false);
        

        document.querySelector(".hero-cd").addEventListener('mouseenter', function(event){
            document.querySelector(".hover-message.show").style.display = 'block';

        }, false);

        document.querySelector(".hero-cd").addEventListener('mouseleave', function(event){
            document.querySelector(".hover-message.show").style.display = 'none';

        }, false);


        document.querySelector(".hero-cd").addEventListener('click', function(event){
            this.classList.remove('allow-rotation');

            document.querySelector(".hero-text").style.display='block';
            document.querySelector("body#shop #app section.hero .hover-message").style.display = 'none';
            document.querySelector("body#shop #app section.hero .hero-cd-text-wrapper .hero-cd").style.cursor = 'auto';

            document.querySelector("body#shop #app section.hero .hover-message").classList.remove('show');

        }, false);
    }


    if (window.innerWidth>=1200) {

        document.querySelector(".hero-cd").addEventListener('click', function(event){
            // console.log(this.style);
            // this.style.transform = 'translateX(-300px)';

            
            
            setTimeout(() => {

                document.querySelector(".hero-text").style.width='540px';
                document.querySelector(".hero-text").style.padding='50px 40px';

                document.querySelector(".hero-text").style.height='max-content';
            }, 0);

            // document.querySelector(".hero-text").style.height='0';

            setTimeout(() => {
                

                // document.querySelector(".hero-text").style.pointerEvents='1';
                document.querySelector(".hero-text").style.transitionDuration='1.3s';

                document.querySelector(".hero-text").style.opacity='1';
                // document.querySelector(".hero-text").style.transform='none';
                

            }, 1200);

            setTimeout(() => {


                document.querySelector(".hero-text .title").style.opacity='1';
                document.querySelector(".hero-text .body").style.opacity='1';
                document.querySelector(".hero-text .cta-hero-button").style.opacity='1';


            }, 2000);

        }, false);

        // var doc = document.documentElement;
        
        // flag = false;

        // window.onscroll = function(e){
        //     var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
        //     if (top>=20 && !flag) {
        //         console.log(top);

        //         flag = true
        //         setTimeout(() => {

        //             document.querySelector(".hero-text").style.width='540px';
        //             document.querySelector(".hero-text").style.padding='50px 40px';
    
        //             document.querySelector(".hero-text").style.height='max-content';
        //         }, 0);
    
        //         // document.querySelector(".hero-text").style.height='0';
    
        //         setTimeout(() => {
                    
    
        //             // document.querySelector(".hero-text").style.pointerEvents='1';
        //             document.querySelector(".hero-text").style.transitionDuration='1.3s';
    
        //             document.querySelector(".hero-text").style.opacity='1';
        //             // document.querySelector(".hero-text").style.transform='none';
                    
    
        //         }, 1200);
    
        //         setTimeout(() => {
    
    
        //             document.querySelector(".hero-text .title").style.opacity='1';
        //             document.querySelector(".hero-text .body").style.opacity='1';
        //             document.querySelector(".hero-text .cta-hero-button").style.opacity='1';
    
    
        //         }, 2000);
        //     }
        // }
    } else if (window.innerWidth>=992) {


        // var bsDiv = document.querySelector(".hover-message");
        // var x, y;
        // document.querySelector(".hero-cd").addEventListener('mousemove', function(event){
        //     x = event.clientX + 20;
        //     y = event.clientY - 5;                    
        //     if ( typeof x !== 'undefined' ){
        //         bsDiv.style.left = x + "px";
        //         bsDiv.style.top = y + "px";
        //     }
        // }, false);
        

        // document.querySelector(".hero-cd").addEventListener('mouseenter', function(event){
        //     document.querySelector(".hover-message").style.display = 'block';

        // }, false);

        // document.querySelector(".hero-cd").addEventListener('mouseleave', function(event){
        //     document.querySelector(".hover-message").style.display = 'none';

        // }, false);

        document.querySelector(".hero-cd").addEventListener('click', function(event){
            // console.log(this.style);
            // this.style.transform = 'translateX(-300px)';
            // this.classList.remove('allow-rotation');

            // document.querySelector(".hero-text").style.display='block';
            
            setTimeout(() => {

                document.querySelector(".hero-text").style.width='800px';
                document.querySelector(".hero-text").style.padding='50px 40px';

                document.querySelector(".hero-text").style.height='max-content';
            }, 0);

            // document.querySelector(".hero-text").style.height='0';

            setTimeout(() => {
                

                // document.querySelector(".hero-text").style.pointerEvents='1';
                document.querySelector(".hero-text").style.transitionDuration='1.3s';

                document.querySelector(".hero-text").style.opacity='1';
                // document.querySelector(".hero-text").style.transform='none';
                

            }, 1200);

            setTimeout(() => {


                document.querySelector(".hero-text .title").style.opacity='1';
                document.querySelector(".hero-text .body").style.opacity='1';
                document.querySelector(".hero-text .cta-hero-button").style.opacity='1';


            }, 2000);

        }, false);

    }

    

}