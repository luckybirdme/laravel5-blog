(function($){
    var WebSite = {

        init: function(){
            var self = this;
            self.initPjax();
            self.siteBootUp();
        },

        /*
        * Things to be execute when normal page load
        * and pjax page load.
        */
        siteBootUp: function(){
            var self = this;
            self.initExternalLink();
            self.initTimeAgo();
            self.initReloadButton();
            self.initPostTag();
            self.initPostEditor();
            
        },

        initPjax : function(){
            var self = this;
            if ($.support.pjax) {

                $.pjax.defaults.timeout = 2000; // time in milliseconds
                // a tag of links , which open in new window , such as external links , will not load by pajx !
                $(document).pjax('a:not(a[target="_blank"])', '#pjax-container');
                // submit form by pjax too
                $(document).on('submit', '#form', function(event) {
                    $.pjax.submit(event, '#pjax-container');
                })
                
                // for loading flash 
                $(document).on('pjax:send', function(){ 
                    NProgress.start(); 
                  });
                $(document).on('pjax:complete', function() {
                    NProgress.done();  
                });
                // do something for new dom , for example , on click event 
                $(document).on('pjax:end', function(event) {

                    self.siteBootUp();

                });
            }           

        },

        /**
         * Open External Links In New Window
         */
        initExternalLink: function(){
            $('a[href^="http://"], a[href^="https://"]').each(function() {
               var a = new RegExp('/' + window.location.host + '/');
               if(!a.test(this.href) ) {
                   $(this).click(function(event) {
                       event.preventDefault();
                       event.stopPropagation();
                       window.open(this.href, '_blank');
                   });
               }
            });
        },

        initTimeAgo: function(){
            moment.locale('us-en');
            $('.timeago').each(function(){
                var time_str = $(this).text();
                if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
                    $(this).text(moment(time_str).fromNow());
                }
            });
        },

        // pjax will not load new js in pjax-container, so let's stop it and reload js 
        initReloadButton : function(){
            $('.reload-button').click(function(){
                var url = $(this).attr("href");
                location.href = url;
            });
        },


        initPostTag : function(){

            // init tag
            var tagObj = $("#tags-container") 

            if( tagObj.length > 0 ){
                var availableTags ;
                var hasTags = $("#hasTags").val();
                availableTags = eval('(' + hasTags + ')');
                tagObj.tagit({
                    availableTags : availableTags,
                    singleField: true,
                    singleFieldNode: $('#tags')
                });
            }
        },

        initPostEditor : function(){
            // init editor    
            var editorObj = $("#editor");

            if(editorObj.length > 0){
                
                var editor = new Editor({
                    element: editorObj.get(0),
                    status:false
                });
                editor.render();

                initUploadPostImage();

            }   


        },




    }
    window.WebSite = WebSite;
})(jQuery);

$(document).ready(function()
{

	WebSite.init();


});