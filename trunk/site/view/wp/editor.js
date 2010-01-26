/*
* Copyright (C) 2007-2008 opensmt.footoo.org  All rights reserved.
* See COPYRIGHT.php for copyright notices and details.
*/

var Editor = new Class({
    Extents: Fx,
    Implements: Options,
    myIFrame: null,
    options: {
        elements: '.pop'
    },
    initialize: function(options) {
        this.setOptions(options);
        this.options.methods = {
            newIframe: this.newIframe.bind(this),
            IframeUpdate: this.IframeUpdate.bind(this),
            HtmlToText: this.HtmlToText.bind(this),
            setFontB: this.setFontB.bind(this)
            ///stop: this.stop.bind(this),
            //newbox: this.newbox.bind(this),
            //show: this.show.bind(this),
            //setPos: this.setPos.bind(this)
        };
        this.winScrollSize = $(window).getScrollSize();
        this.options.methods.newIframe();
        //$clear(this.timeid);
    },
    HtmlToText: function(htmlString) {

        var length = htmlString.length;
        if (length > 4) {
            htmlString = htmlString.replace(/(.+?)<br>$/gi, '$1');
        }
        if (htmlString == '<br>') {
            htmlString = '';
        }
        var lineArray = htmlString.split('<br>');
        var TextString = '';

        lineArray.each(function(item, index) {
            //if(index != lineArray.length -1)
            TextString += '<p>' + item.trim() + '</p>' + "\n";
        })

        return TextString;
    },
    IeHtmlToText: function(htmlString) {
    
        var TextString = htmlString;
        if (htmlString.search(/<P>(.+?)<\/P>/gi) == -1) {
            htmlString = '<P>' + htmlString + '</P>';
        }
        TextString = htmlString.replace(/<P>(.+?)<\/P>/gi, '<p>$1</p>');
        TextString = TextString.replace(/<P>&nbsp;<\/P>/gi, '<p></p>');
        var lineArray = htmlString.split('\n');
        return TextString;
    },
    IframeUpdate: function(event, iframeID) {
        editor = iframeID.contentWindow.document;
        var html = $(editor.body).get('html'); //alert(html);

        
        if (Browser.Engine.trident) {//IE
            var text = this.IeHtmlToText(html);
        } else {//No IE
            var text = this.HtmlToText(html);
        }
     

        // html = html.replace(/\r\n/,"\n");


        $('textHtml').set('value', text + "@" + $(editor.body).get('html'));
        $('htmllook').set('html', html);

        //alert('编辑器载入完成');
    },
    setFontB: function() {
        sel = this.getSelect();
        if (sel.text == '') {

        } else {
            this.insertHTML('<b>' + sel.text + '</b>', sel.iframe);
        }
    },
    format: function(what, opt, Editor) {
        Editor.contentWindow.focus();
        Editor.contentWindow.document.execCommand(what, false, opt);
    },
    insertHTML: function(html, Editor) {
       
        if (window.event) {
            Editor.contentWindow.document.selection.createRange().pasteHTML(html);
        } else {
            this.format("insertHTML", html, Editor);
        }
        this.IframeUpdate(null, Editor);
    },
    getSelect: function() {
        var Editor = $('iframeName').contentWindow;
        var text = '';
        if (document.all) {//如果是 IE. (虽然，FF也可以用document.all)
            text = Editor.document.selection.createRange().text;
        } else {
            //alert(Editor.document.getSelection());
            text = Editor.getSelection();
            //alert(Editor.getSelection());
            // var selection = Editor.getSelection().getRangeAt(0);
            //var linkElement = Editor.document.createElement("a"); //创建一个新的<A>节点
            //linkElement.href = "http://asers.blog.sohu.com"; //设置<A>节点的href属性
            //selection.surroundContents(linkElement); //加入超链接
        }
        return { text: text, iframe: $('iframeName') };
    },
    newIframe: function() {

        $('iframeName').contentWindow.document.designMode = 'On';
        var myIFrame = new IFrame('iframeName', {
            events: {
                mouseenter1: function() {
                    alert('Welcome aboard.');
                },
                keydown: function(event) {
                    alert(event.keyCode)
                },
                mouseleave1: function() {
                    alert('Goodbye!');
                },
                mouseenter: function() {


                },
                load: function() {

                }
            }
        });

        this.myIFrame = myIFrame;
        this.setDesignMode();
        return this.binds();
    },
    binds: function() {
        try {
            $(this.getDoc()).addEvent('keyup', this.options.methods.IframeUpdate.bindWithEvent(this, this.myIFrame));
            $('content_bold').addEvent('click', this.options.methods.setFontB.bindWithEvent(this, this.myIFrame));
        } catch (e) {
            alert(e.toString())
        }
    },
    getWin: function() {
        return this.myIFrame.contentWindow;
    },
    getDoc: function() {
        return this.getWin().document;
    },
    setDesignMode: function() {

    }
})