var ajax = {
	url:null ,
	type:'get',
	params:{},
	form:null,

	prepareRequestParams: function(){
		this.setUrl(this.getForm().attr("action"));
		this.setMethod(this.getForm().attr("method"));
		this.setParams(this.getForm().serializeArray());
	},
	setForm:function(formId){
		this.form = $("#"+formId);
		this.prepareRequestParams();
		return this;
	},
	getForm:function(){
		return this.form;
	},
	setUrl:function(url){
		this.url = url;
		return this;
	},
	getUrl:function(){
		return this.url;
	},
	setMethod:function(method){
		this.type = method;
		return this;
	},
	getMethod:function(){
		return this.type;
	},
	setParams:function(params){
		this.params = params;
		return this;
	},
	getParams:function(){
		return this.params;
	},
	call:function(){
		$.ajax({
			url:this.getUrl(),
			type:this.getMethod(),
			data:this.getParams(),
			dataType:'json'
		}).done(function(response){
			// alert(response.html);
			$("#"+response.element).html(response.html);
			
		})
	}
};
