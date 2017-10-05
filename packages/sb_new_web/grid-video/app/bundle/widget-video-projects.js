!function(e){function t(l){if(i[l])return i[l].exports;var s=i[l]={exports:{},id:l,loaded:!1};return e[l].call(s.exports,s,s.exports,t),s.loaded=!0,s.exports}var i={};return t.m=e,t.c=i,t.p="",t(0)}([function(e,t,i){var l,s;l=i(15),s=i(24),e.exports=l||{},e.exports.__esModule&&(e.exports=e.exports["default"]),s&&(("function"==typeof e.exports?e.exports.options||(e.exports.options={}):e.exports).template=s)},function(e,t){e.exports='<template v-for="field in fields"> <dt v-if=field.label> <i v-if=field.tip class="uk-icon-info uk-icon-hover uk-margin-small-right" data-uk-tooltip="{delay: 100}" :title=field.tip></i> {{ field.label }} </dt> <dd> <component :is=field.type :field=field></component> </dd> </template>'},function(e,t){e.exports='<div v-for="field in fields" :class="{\'uk-form-row\': !field.raw}"> <label v-if=field.label class=uk-form-label> <i v-if=field.tip class="uk-icon-info uk-icon-hover uk-margin-small-right" data-uk-tooltip="{delay: 100}" :title=field.tip></i> {{ field.label | trans }} </label> <div v-if=!field.raw class=uk-form-controls :class="{\'uk-form-controls-text\': [\'checkbox\', \'radio\'].indexOf(field.type)>-1}"> <component :is=field.type :field=field></component> </div> <component v-else :is=field.type :field=field></component> </div>'},function(e,t){e.exports='<template v-for="field in fields"> <component :is=field.type :field=field></component> </template>'},function(e,t,i){Vue.component("sbvideo-fields",{"extends":Vue.component("fields"),template:i(2),fields:{text:'<input type="text" v-bind="attrs" v-model="value">',textarea:'<textarea v-bind="attrs" v-model="value"></textarea>',select:'<select v-bind="attrs" v-model="value"><option v-for="option in options" :value="option">{{ $key }}</option></select>',radio:'<p class="uk-form-controls-condensed"><label v-for="option in options" v-bind="attrs"><input type="radio" :value="option" v-model="value"> {{ $key }}</label></p>',checkbox:'<p class="uk-form-controls-condensed"><label><input type="checkbox" v-bind="attrs" v-model="value" v-bind:true-value="1" v-bind:false-value="0" number> {{ optionlabel }}</label></p>',email:'<input type="email" v-bind="attrs" v-model="value">',number:'<input type="number" v-bind="attrs" v-model="value" number>',title:'<h3 v-bind="attrs">{{ title }}</h3>',paragraph:'<p v-bind="attrs">{{ text }}</p>',price:'<i class="uk-icon-euro uk-margin-small-right"></i><input type="number" v-bind="attrs" v-model="value" number>',multiselect:'<multiselect :values.sync="value" :options="options"></multiselect>',tags:'<input-tags v-bind="attrs" :tags.sync="value" :existing="options" :style="style || \'tags\'"></input-tags>',format:'<span v-bind="attrs">{{ value }}</span>'}}),Vue.component("sbvideo-fields-raw",{"extends":Vue.component("sbvideo-fields"),template:i(3)}),Vue.component("sbvideo-fields-list",{"extends":Vue.component("sbvideo-fields"),template:i(1)})},function(e,t,i){var l=i(6);e.exports={video:{project_ordering:{type:"select",label:"Project ordering",options:{"Newest first":"date|DESC","Newest last":"date|ASC",Title:"title|ASC",Ordering:"priority|ASC"},attrs:{"class":"uk-form-width-medium"}},video_image_align:{type:"select",label:"Image alignment",options:l.align.general,attrs:{"class":"uk-form-width-small"}},filter_tags:{type:"checkbox",label:"Grid filter",optionlabel:"Filter by tags"},title1:{raw:!0,type:"title",label:"",title:"Project columns",attrs:{"class":"uk-margin-top"}},columns:{type:"select",label:"Phone Portrait",options:l.gridcols.base,attrs:{"class":"uk-form-width-small"}},columns_small:{type:"select",label:"Phone Landscape",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},columns_medium:{type:"select",label:"Tablet",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},columns_large:{type:"select",label:"Desktop",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},columns_xlarge:{type:"select",label:"Large screens",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},columns_gutter:{type:"select",label:"Gutter width",options:l.gutter,attrs:{"class":"uk-form-width-small"}}},teaser_columns:{title2:{raw:!0,type:"title",label:"",title:"Teaser thumbs columns",attrs:{"class":"uk-margin-top"}},"teaser.columns":{type:"select",label:"Phone Portrait",options:l.gridcols.base,attrs:{"class":"uk-form-width-small"}},"teaser.columns_small":{type:"select",label:"Phone Landscape",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"teaser.columns_medium":{type:"select",label:"Tablet",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"teaser.columns_large":{type:"select",label:"Desktop",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"teaser.columns_xlarge":{type:"select",label:"Large screens",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}}},teaser_show:{"teaser.show_title":{type:"checkbox",label:"Show content",optionlabel:"Show title"},"teaser.show_subtitle":{type:"checkbox",optionlabel:"Show subtitle"},"teaser.show_intro":{type:"checkbox",optionlabel:"Show intro"},"teaser.show_image":{type:"checkbox",optionlabel:"Show image"},"teaser.show_date":{type:"checkbox",optionlabel:"Show date"},"teaser.show_client":{type:"checkbox",optionlabel:"Show client"},"teaser.show_tags":{type:"checkbox",optionlabel:"Show tags"},"teaser.show_thumbs":{type:"checkbox",optionlabel:"Show thumbs"},"teaser.show_data":{type:"checkbox",optionlabel:"Show data"},"teaser.show_readmore":{type:"checkbox",optionlabel:"Show readmore"}},teaser_top:{"teaser.template":{type:"select",label:"Teaser template",options:{Panel:"panel",Overlay:"overlay"},attrs:{"class":"uk-form-width-medium"}}},template:{panel:{"teaser.panel_style":{type:"select",label:"Panel style",options:l.panel_style,attrs:{"class":"uk-form-width-medium"}}},overlay:{"teaser.overlay":{type:"select",label:"Overlay",options:{None:"",Always:"uk-overlay","On hover":"uk-overlay uk-overlay-hover"},attrs:{"class":"uk-form-width-medium"}},"teaser.overlay_position":{type:"select",label:"Overlay position",options:{"Cover image":"",Top:"uk-overlay-top",Bottom:"uk-overlay-bottom",Left:"uk-overlay-left",Right:"uk-overlay-right"},attrs:{"class":"uk-form-width-medium"}},"teaser.overlay_effect":{type:"select",label:"Overlay effect",options:{None:"",Fade:"uk-overlay-fade","Slide top":"uk-overlay-slide-top","Slide bottom":"uk-overlay-slide-bottom","Slide left":"uk-overlay-slide-left","Slide right":"uk-overlay-slide-right"},attrs:{"class":"uk-form-width-medium"}},"teaser.overlay_image_effect":{type:"select",label:"Overlay image effect",options:{None:"",Scale:"uk-overlay-scale",Rotate:"uk-overlay-rotate",Grayscale:"uk-overlay-grayscale"},attrs:{"class":"uk-form-width-medium"}}}},teaser_bottom:{"teaser.content_align":{type:"select",label:"Content alignment",options:l.align.general,attrs:{"class":"uk-form-width-medium"}},"teaser.title_size":{type:"select",label:"Teaser title size",options:l.heading_size,attrs:{"class":"uk-form-width-medium"}},"teaser.title_color":{type:"select",label:"Teaser title color",options:l.text_color,attrs:{"class":"uk-form-width-medium"}},"teaser.tags_align":{type:"select",label:"Tags alignment",options:l.align.flex,attrs:{"class":"uk-form-width-medium"}},"teaser.read_more":{label:"Read more text",attrs:{"class":"uk-form-width-medium"}},"teaser.link_image":{label:"Link image",type:"checkbox"},"teaser.read_more_style":{type:"select",label:"Read more button style",options:{"Overlay (when selected)":"overlay",Link:"uk-link",Button:"uk-button","Button primary":"uk-button uk-button-primary","Button success":"uk-button uk-button-success","Button link":"uk-button uk-button-link"},attrs:{"class":"uk-form-width-medium"}},"teaser.readmore_align":{type:"select",label:"Readmore alignment",options:l.align.text,attrs:{"class":"uk-form-width-medium"}}},project:{"project.image_align":{type:"select",label:"Image alignment",options:l.align.general,attrs:{"class":"uk-form-width-medium"}},"project.metadata_position":{type:"select",label:"Metadata position",options:l.position.page,attrs:{"class":"uk-form-width-medium"}},"project.tags_align":{type:"select",label:"Tags alignment",options:l.align.flex,attrs:{"class":"uk-form-width-medium"}},"project.tags_position":{type:"select",label:"Tags position",options:l.position.page,attrs:{"class":"uk-form-width-medium"}},"project.show_navigation":{type:"select",label:"Position navigation",options:l.position.nav,attrs:{"class":"uk-form-width-medium"}},"project.overlay_title_size":{type:"select",label:"Overlay title size",options:l.heading_size,attrs:{"class":"uk-form-width-medium"}},"project.overlay":{type:"select",label:"Overlay",options:{None:"",Always:"uk-overlay","On hover":"uk-overlay uk-overlay-hover"},attrs:{"class":"uk-form-width-medium"}},"project.overlay_position":{type:"select",label:"Overlay position",options:{"Cover image":"",Top:"uk-overlay-top",Bottom:"uk-overlay-bottom",Left:"uk-overlay-left",Right:"uk-overlay-right"},attrs:{"class":"uk-form-width-medium"}},"project.overlay_effect":{type:"select",label:"Overlay effect",options:{None:"",Fade:"uk-overlay-fade","Slide top":"uk-overlay-slide-top","Slide bottom":"uk-overlay-slide-bottom","Slide left":"uk-overlay-slide-left","Slide right":"uk-overlay-slide-right"},attrs:{"class":"uk-form-width-medium"}},"project.overlay_image_effect":{type:"select",label:"Overlay image effect",options:{None:"",Scale:"uk-overlay-scale",Rotate:"uk-overlay-rotate",Grayscale:"uk-overlay-grayscale"},attrs:{"class":"uk-form-width-medium"}},title1:{raw:!0,type:"title",label:"",title:"Image columns",attrs:{"class":"uk-margin-top"}},"project.columns":{type:"select",label:"Phone Portrait",options:l.gridcols.base,attrs:{"class":"uk-form-width-small"}},"project.columns_small":{type:"select",label:"Phone Landscape",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"project.columns_medium":{type:"select",label:"Tablet",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"project.columns_large":{type:"select",label:"Desktop",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}},"project.columns_xlarge":{type:"select",label:"Large screens",options:l.gridcols.inherit,attrs:{"class":"uk-form-width-small"}}},general:{projects_per_page:{type:"number",label:"Projects per page",attrs:{"class":"uk-form-width-small"}},date_format:{type:"select",label:"Date format",options:{"January 2015":"F Y","January 15 2015":"F d Y","15 January 2015":"d F Y","Jan 2015":"M Y","1 2015":"m Y","1-15-2015":"m-d-Y","15-1-2015":"d-m-Y"},attrs:{"class":"uk-form-width-medium"}},cache_path:{type:"text",label:"Cache folder images",attrs:{"class":"uk-form-width-large"}}}}},function(e,t){e.exports={gridcols:{base:{1:"1",2:"2",3:"3",4:"4",5:"5",6:"6"},inherit:{Inherit:"",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6"}},gutter:{Collapse:"0","10 px":"10","20 px":"20","30 px":"30"},align:{general:{Left:"left",Right:"right",Center:"center"},text:{Left:"uk-text-left",Right:"uk-text-right",Center:"uk-text-center"},flex:{Left:"",Right:"uk-flex-right",Center:"uk-flex-center"}},heading_size:{"Heading H1":"uk-h1","Heading H2":"uk-h2","Heading H3":"uk-h3","Heading H4":"uk-h4","Large header":"uk-heading-large","Module header":"uk-module-title","Article header":"uk-article-title"},text_color:{Normal:"",Primary:"uk-text-primary",Contrast:"uk-text-contrast",Muted:"uk-text-muted",Success:"uk-text-success",Warning:"uk-text-warning",Danger:"uk-text-danger"},button_style:{Link:"uk-link",Button:"uk-button","Button primary":"uk-button uk-button-primary","Button success":"uk-button uk-button-success","Button link":"uk-button uk-button-link"},panel_style:{Raw:"","Panel box":"uk-panel-box","Panel box primary":"uk-panel-box uk-panel-box-primary","Panel box secondary":"uk-panel-box uk-panel-box-secondary","Panel space":"uk-panel-space"},position:{page:{"Don't show":"","Content top":"content-top",Sidebar:"sidebar"},nav:{"Don't show":"",Top:"top",Bottom:"bottom",Both:"both"}}}},function(e,t){"use strict";e.exports={name:"input-related-items",props:{model:{type:Array,"default":function(){return[]}},selected:{type:Array,"default":function(){return{}}},resource:{type:String,"default":""},config:{type:Object,"default":function(){return{filter:{search:"",order:"title asc"}}}},name:{type:String,"default":"items"},identifier:{type:String,"default":"id"},label:{type:String,"default":"title"},extra_key:{type:String,"default":"slug"},onSelect:{type:Function,"default":function(){_.noop()}},onRemove:{type:Function,"default":function(){_.noop()}}},watch:{selected:function(e){this.model=_.map(e,function(e){return this.getIdentifier(e)},this)}},methods:{pick:function(){this.$refs.modal.open()},select:function(){var e=_.filter(this.$refs.tableList.getSelected(),function(e){return void 0===_.find(this.selected,this.identifier,this.getIdentifier(e))},this);this.selected=this.selected.concat(e),this.onSelect(e),this.$refs.modal.close()},remove:function(e){this.selected.$remove(e),this.onRemove(e)},getIdentifier:function(e){return e[this.identifier]||""},getLabel:function(e){return e[this.label]||""},getExtraKey:function(e){return this.extra_key?e[this.extra_key]||"":""},hasSelection:function(){return this.$refs.tableList.nrSelected()>0},isSelected:function(e){return this.selected===e}}}},function(e,t){"use strict";e.exports={name:"table-list",props:{config:{type:Object,"default":function(){return{filter:{search:"",order:"title asc"}}}},resource:{type:String,"default":""},excluded:{type:Array,"default":function(){return[]}},identifier:{type:String,"default":"id"},name:{type:String,"default":"items"},extra_key:{type:String,"default":"slug"},limit:{type:Number,"default":10},label:{type:String,"default":"title"}},data:function(){return{items:!1,pages:0,count:"",selected:[]}},created:function(){this.Resource=this.$resource(this.resource),this.config.filter.limit=this.limit,this.$watch("config.page",this.load,{immediate:!0})},watch:{"config.filter":{handler:function(e){this.config.page?this.config.page=0:this.load()},deep:!0}},methods:{active:function(e){return-1!=this.selected.indexOf(String(e[this.identifier]))},disabled:function(e){return-1!=this.excluded.indexOf(e[this.identifier])},load:function(){this.Resource.query(this.config).then(function(e){var t=e.data;this.$set("items",t[this.name]),this.$set("pages",t.pages),this.$set("count",t.count),this.$set("selected",[])},function(){this.$notify("Loading failed.","danger")})},select:function(e){var t=String(e[this.identifier]);-1===this.selected.indexOf(t)&&this.selected.push(t)},getLabel:function(e){return e[this.label]||""},getIdentifier:function(e){return String(e[this.identifier])||""},getExtraKey:function(e){return this.extra_key?e[this.extra_key]||"":""},nrSelected:function(){return this.selected.length},getSelected:function(){return this.items.filter(function(e){return-1!==this.selected.indexOf(String(e[this.identifier]))},this)}}}},,,,,,,function(e,t,i){"use strict";e.exports={section:{label:"Settings"},replace:!1,fields:i(5),props:["widget","config","form"],created:function(){this.$options.partials=this.$parent.$options.partials,this.$set("widget.data.content_selection",this.widget.data.content_selection||"random"),this.$set("widget.data.layout",this.widget.data.layout||"panel"),this.$set("widget.data.count",this.widget.data.count||4),this.$set("widget.data.items",this.widget.data.items||[]),this.$set("widget.data.items_data",this.widget.data.items_data||[]),this.$set("widget.data.teaser",this.widget.data.teaser||{show_title:!0,show_subtitle:!0,show_intro:!0,show_image:!0,show_client:!0,show_tags:!0,show_date:!0,show_data:!0,show_readmore:!0,show_thumbs:!0,template:"panel",panel_style:"uk-panel-box",overlay:"uk-overlay uk-overlay-hover",overlay_position:"",overlay_effect:"uk-overlay-fade",overlay_image_effect:"uk-overlay-scale",content_align:"left",tags_align:"uk-flex-center",title_size:"uk-h3",title_color:"",read_more:"Read more",link_image:"uk-button",read_more_style:"uk-button",readmore_align:"uk-text-center",thumbsize:{width:400,height:""},columns:1,columns_small:2,columns_medium:"",columns_large:4,columns_xlarge:6,columns_gutter:20})}},i(4),window.Vue.component("input-related-items",i(25)),window.Vue.component("table-list",i(26)),window.Widgets.components["sbvideo-video-projects:settings"]=e.exports},function(e,t){e.exports='<div> <div class=uk-grid> <div v-for="item in selected" class=uk-width-1-1> <div class="uk-badge uk-flex uk-flex-middle uk-margin-small-bottom" track-by=$index> <em class="uk-text-small uk-margin-small-right">{{ getIdentifier(item) }}</em> <span class="uk-flex-item-1 uk-text-left">{{ getLabel(item) }} </span> <small v-if=extra_key class=uk-margin-small-left>({{ getExtraKey(item) }})</small> <a @click=remove(item) class="uk-close uk-margin-small-left"></a> </div> </div> </div> <p> <button type=button class="uk-button uk-button-small" @click=pick>{{ \'Please select\' | trans }}</button> </p> <v-modal v-ref:modal large> <table-list v-ref:table-list :resource=resource :config=config :excluded=model :name=name :extra_key=extra_key :label=label :identifier=identifier></table-list> <div class="uk-modal-footer uk-text-right"> <button class="uk-button uk-button-link uk-modal-close" type=button>{{ \'Cancel\' | trans }}</button> <button class="uk-button uk-button-primary" type=button :disabled=!hasSelection() @click=select()> {{ \'Select\' | trans }} </button> </div> </v-modal> </div>'},function(e,t){e.exports='<div> <div class="uk-form uk-form-icon"> <i class=uk-icon-search></i> <input type=search v-model=config.filter.search :placeholder="\'Search\' | trans" debounce=300> </div> <div class="uk-margin uk-overflow-container"> <table class="uk-table uk-table-hover uk-table-middle uk-form"> <thead> <tr> <th class=pk-table-width-minimum><input type=checkbox v-check-all:selected.literal="input[name=id]"></th> <th class=pk-table-min-width-100>{{ \'ID\' | trans }}</th> <th class=pk-table-min-width-200>{{ \'Name\' | trans }}</th> <th v-if=extra_key class=pk-table-min-width-100>{{ \'Extra\' | trans }}</th> </tr> </thead> <tbody> <tr class=check-item v-for="item in items" :class="{\'uk-active\': active(item)}"> <td><input type=checkbox name=id :value=getIdentifier(item) :disabled=disabled(item)></td> <td>{{ getIdentifier(item) }}</td> <td> <span v-if=disabled(item) class=uk-text-muted>{{ getLabel(item) }}</span> <a v-else @click=select(item)>{{ getLabel(item) }}</a> </td> <td v-if=extra_key>{{ getExtraKey(item) }}</td> </tr> </tbody> </table> </div> <h3 v-show="items && !items.length" class="uk-text-muted uk-text-center">{{ \'No items found.\' | trans }}</h3> <v-pagination :page.sync=config.page :pages=pages v-show="pages > 1" :replace-history=false></v-pagination> </div>'},,,,,,,function(e,t){e.exports="<div class=\"uk-grid pk-grid-large pk-width-sidebar-large\" data-uk-grid-margin> <div class=\"pk-width-content uk-form-horizontal\"> <div class=uk-form-row> <label for=form-title class=uk-form-label>{{ 'Title' | trans }}</label> <div class=uk-form-controls> <input id=form-title class=uk-form-width-large type=text name=title v-model=widget.title v-validate:required> <p class=\"uk-form-help-block uk-text-danger\" v-show=form.title.invalid> {{ 'Title cannot be blank.' | trans }}</p> </div> </div> <div class=uk-form-row> <label for=form-content_selection class=uk-form-label>{{ 'Content selectie' | trans }}</label> <div class=uk-form-controls> <select id=form-content_selection v-model=widget.data.content_selection class=uk-form-width-medium> <option value=random>{{ 'Random' | trans }}</option> <option value=latest>{{ 'New projects first' | trans }}</option> <option value=pick>{{ 'Select items' | trans }}</option> </select> </div> </div> <div v-if=\"widget.data.content_selection == 'pick'\" class=uk-form-row> <label class=uk-form-label>{{ 'Select items' | trans }}</label> <div class=uk-form-controls> <input-related-items :model.sync=widget.data.items :selected.sync=widget.data.items_data resource=api/video/project name=projects></input-related-items> </div> </div> <div class=uk-form-row> <label for=form-count class=uk-form-label>{{ 'Count' | trans }}</label> <div class=uk-form-controls> <input id=form-count class=\"uk-form-width-small uk-text-right\" type=number name=count v-model=widget.data.count min=0 number> </div> </div> <h3>{{ 'Teaser settings' | trans }}</h3> <div class=\"uk-grid uk-grid-width-medium-1-2\" data-uk-grid-margin> <div> <div class=uk-form-row> <span class=uk-form-label>{{ 'Show content' | trans }}</span> <div class=\"uk-form-controls uk-form-controls-text\"> <sbvideo-fields-raw :config=$options.fields.teaser_show :values.sync=widget.data></sbvideo-fields-raw> </div> </div> <sbvideo-fields :config=$options.fields.teaser_top :values.sync=widget.data></sbvideo-fields> <sbvideo-fields :config=$options.fields.template[widget.data.teaser.template] :values.sync=widget.data></sbvideo-fields> </div> <div> <sbvideo-fields :config=$options.fields.teaser_bottom :values.sync=widget.data></sbvideo-fields> <div class=uk-form-row> <label for=form-project_image_align class=uk-form-label>{{ 'Thumbs size' | trans }}</label> <div class=\"uk-form-controls uk-form-controls-text\"> <p class=uk-form-controls-condensed> <label class=uk-form-label style=\"width: 70px\">{{ 'Width' | trans }}</label> <input type=number placeholder=\"{{ 'Auto' | trans }}\" class=uk-form-width-small v-model=widget.data.teaser.thumbsize.width> </p> <p class=uk-form-controls-condensed> <label class=uk-form-label style=\"width: 70px\">{{ 'Height' | trans }}</label> <input type=number placeholder=\"{{ 'Auto' | trans }}\" class=uk-form-width-small v-model=widget.data.teaser.thumbsize.height> </p> </div> </div> <sbvideo-fields :config=$options.fields.teaser_columns :values.sync=widget.data></sbvideo-fields> </div> </div> </div> <div class=pk-width-sidebar> <partial name=settings></partial> </div> </div>"},function(e,t,i){var l,s;l=i(7),s=i(16),e.exports=l||{},e.exports.__esModule&&(e.exports=e.exports["default"]),s&&(("function"==typeof e.exports?e.exports.options||(e.exports.options={}):e.exports).template=s)},function(e,t,i){var l,s;l=i(8),s=i(17),e.exports=l||{},e.exports.__esModule&&(e.exports=e.exports["default"]),s&&(("function"==typeof e.exports?e.exports.options||(e.exports.options={}):e.exports).template=s)}]);