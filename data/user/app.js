angular.module('scotchApp').controller('usuarioController', function ($scope, $route) {
	
	$scope.$route = $route;

	jQuery(function($) {	
		$("#avatar-2").fileinput({			    		
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    minImageWidth: 50,
    		minImageHeight: 50,    	
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancelar o Resetear Cambios',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="dist/avatars/default.jpg" id="temp" alt="Tu Avatar" style="width:160px;height:150px"><h6 class="text-muted">Seleccione</h6>',
		    layoutTemplates: {main2: '{preview}  {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});


		$('[data-toggle="tooltip"]').tooltip(); 

		$(".select2").css({
			width: '100%',
		    allow_single_deselect: true,
		    no_results_text: "No se encontraron resultados",
		    }).select2().on("change", function (e) {
			$(this).closest('form').validate().element($(this));
	    });

		$("#select_cargo").select2({
		  allowClear: true 
		}); 

		//validacion formulario usuarios
		$('#form_user').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {				
				txt_1: {
					required: true				
				},
				txt_2: {
					required: true				
				},				
				txt_7: {
					required: true				
				},
				txt_4: {
					required: true				
				},
				txt_5: {
					required: true									
				},
				txt_3: {
					required: true,
					minlength: 5
				},
				txt_6: {
					required: true,
					minlength: 5,
					equalTo: "#txt_3"
				},
				select_cargo: {
					required: true				
				},				
				select_genero: {
					required: true				
				},				

			},
			messages: {								
				txt_1: { 	
					required: "Por favor, Indique nombres completos",			
				},
				txt_4: { 	
					required: "Por favor, Indique apellidos completos",			
				},								
				txt_2: {
					required: "Por favor, Indique un usuario",
				},
				txt_5: { 	
					required: "Por favor, Indique un correo",			
				},
				txt_7: {
					required: "Por favor, Indique la dirección del usuario",
				},
				txt_3: {
					required: "Por favor, Especificar una contraseña",
					minlength: "Por favor, introduzca al menos 5 caracteres"
				},
				txt_6: {
					required: "Por favor, Indique una contraseña",
					minlength: "Por favor, introduzca al menos 5 caracteres",
					equalTo: "Por favor, introduzca el mismo valor de nuevo"
				},
				select_cargo: {
					required: "Por favor, Especifique el cargo",
				},
				select_genero: {
					required: "Por favor, Especifique un genero",
				},
			},
			//para prender y apagar los errores
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				
			}
		});
	
		// recargar formulario
		function redireccionar() {
			setTimeout(function() {
			    location.reload(true);
			}, 1000);
		}
		// fin

		function llenar_select_nivel() {			
			$.ajax({
				url: 'data/user/app.php',
				type: 'post',
				data: {
					llenar_nivel:'llenar_nivel'
				},
				success: function (data) {					
					$('#select_nivel').html(data);
				}
			});
		}

		llenar_select_nivel();
		$('#btn_3').attr('disabled', true);		

		// guardar formulario
		$('#btn_0').click(function(e) {
			var respuesta = $('#form_user').valid();			
			if (respuesta == true) {
				$('#btn_0').attr('disabled', true);
				var submit = "btn_guardar";
				var formulario = $("#form_user").serialize();
				var archivos = document.getElementById("avatar-2");				
		    	var archivo = archivos.files;
		    	var archivos = new FormData(document.getElementById("form_user"));
		    	console.log(archivo)
				$.ajax({
			        url: "data/user/app.php?btn_guardar=" + submit+ "&" + formulario,			        
			        type: "POST",			        			        
			        contentType:false,			        			        
			        data: archivos,        
			        processData:false,
			        cache:false,    
			        //async: true,
			        success: function (data) {
			        	var val = data;
			        	if(data == '1') {
			        		$.gritter.add({
								title: 'Mensaje',
								text: 'Registro Agregado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
								image: 'dist/images/ok.png', 
								time: 2000				
							});
							redireccionar();
				    	}              
				    	if(data == '2') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">El usuario ya exite Intente Nuevamente </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"> </span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							$("#txt_2").val("");
							$("#txt_2").focus();
							$('#btn_0').attr('disabled', false);
				    	}              
				    	if(data == '3') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">El correo ya existe Intenete Nuevamente </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"></span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							$("#txt_5").val("");
							$("#txt_5").focus();
							$('#btn_0').attr('disabled', false);
				    	}        
				    	if(data == '4') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">Error al generar Nuevo Usuario Contacte con el Administrador </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"></span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							redireccionar();
				    	}                  
			        },
			        error: function (xhr, status, errorThrown) {
				        alert("Hubo un problema!");
				        console.log("Error: " + errorThrown);
				        console.log("Status: " + status);
				        console.dir(xhr);
			        }
			    });
			}		 
		});
		// fin

		// refrescar formulario
		$('#btn_1').click(function() {
			location.reload(true);
		});
		// fin

		$('#btn_2').click(function() {
			$('#myModal').modal('show');
		});

		// modificar formulario
		$('#btn_3').click(function() {
			
			var respuesta = $('#form_user').valid();			
			if (respuesta == true) {
				$('#btn_3').attr('disabled', true);
				var submit = "btn_modificar";
				var formulario = $("#form_user").serialize();
				var archivos = document.getElementById("avatar-2");				
		    	var archivo = archivos.files;
		    	var archivos = new FormData(document.getElementById("form_user"));
		    	console.log(archivo)
				$.ajax({
			        url: "data/user/app.php?btn_modificar=" + submit+ "&" + formulario,			        
			        type: "POST",			        			        
			        contentType:false,			        			        
			        data: archivos,        
			        processData:false,
			        cache:false,    
			        //async: true,
			        success: function (data) {
			        	var val = data;
			        	if(data == '1') {
			        		$.gritter.add({
								title: 'Mensaje',
								text: 'Registro Modificado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
								image: 'dist/images/ok.png', 
								time: 2000				
							});
							redireccionar();
				    	}              
				    	if(data == '2') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">El usuario ya exite Intente Nuevamente </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"> </span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							$("#txt_2").val("");
							$("#txt_2").focus();
							$('#btn_0').attr('disabled', false);
				    	}              
				    	if(data == '3') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">El correo ya existe Intenete Nuevamente </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"></span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							$("#txt_5").val("");
							$("#txt_5").focus();
							$('#btn_0').attr('disabled', false);
				    	}        
				    	if(data == '4') {
			        		$.gritter.add({
								title: '<span>Información Mensaje</span>',
								text: '	<span class="fa fa-shield"></span>'
											+' <span class="text-info">Error al Modificar Usuario Contacte con el Administrador </span>'
										+' <span class="fa fa-ban fa-stack-2x text-danger"></span>',
								image: 'dist/images/error.png', 
								sticky: false,
								time: 3000,												
							});	
							redireccionar();
				    	}                  
			        },
			        error: function (xhr, status, errorThrown) {
				        alert("Hubo un problema!");
				        console.log("Error: " + errorThrown);
				        console.log("Status: " + status);
				        console.dir(xhr);
			        }
			    });
			}		 
		});
		// fin

		/*jqgrid*/    
		jQuery(function($) {
		  	var grid_selector = "#table";
		    var pager_selector = "#pager";
		    
		    //cambiar el tamaño para ajustarse al tamaño de la página
		    $(window).on('resize.jqGrid', function () {
		        //$(grid_selector).jqGrid( 'setGridWidth', $("#myModal").width());	        
		        $(grid_selector).jqGrid( 'setGridWidth', $("#myModal .modal-dialog").width()-30);
		    });
		    //cambiar el tamaño de la barra lateral collapse/expand
		    var parent_column = $(grid_selector).closest('[class*="col-"]');
		    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
		        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
		            //para dar tiempo a los cambios de DOM y luego volver a dibujar!!!
		            setTimeout(function() {
		                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
		            }, 0);
		        }
		    });

		    // buscador clientes
		    jQuery(grid_selector).jqGrid({	        
		        datatype: "xml",
		        url: 'data/user/xml_usuarios.php',        
		        colNames: ['ID','Usuario','Nombres','Apellidos','Dirección','Cargo','Correo','Genero','Imagén','Clave'],
		        colModel:[      
		            {name:'id',index:'id', frozen:true, align:'left', search:false, hidden: false},
		            {name:'usuario',index:'usuario',frozen : true, hidden: false, align:'left',search:true,width: ''},
		            {name:'nombres',index:'nombres',frozen : true, hidden: false, align:'left',search:true,width: ''},
		            {name:'apellidos',index:'apellidos',frozen : true, hidden: false, align:'left',search:false,width: ''},
		            {name:'direccion',index:'direccion',frozen : true, hidden: false, align:'left',search:false,width: ''},
		            {name:'cargo',index:'cargo',frozen : true, hidden: true, align:'left',search:false,width: ''},
		            {name:'correo',index:'correo',frozen : true, hidden: false, align:'left',search:false,width: ''},
		            {name:'genero',index:'genero',frozen : true, hidden: true, align:'left',search:false,width: ''},
		            {name:'imagen',index:'imagen',frozen : true, hidden: true, align:'left',search:false,width: ''},		            
		            {name:'clave',index:'clave',frozen : true, hidden: true, align:'left',search:false,width: ''}, 
		        ],          
		        rowNum: 10,       
		        width:600,
		        shrinkToFit: true,
		        height:200,
		        rowList: [10,20,30],
		        pager: pager_selector,        
		        sortname: 'id',
		        sortorder: 'asc',
		        altRows: true,
		        multiselect: false,
		        multiboxonly: true,
		        viewrecords : true,
		        loadComplete : function() {
		            var table = this;
		            setTimeout(function(){
		                styleCheckbox(table);
		                updateActionIcons(table);
		                updatePagerIcons(table);
		                enableTooltips(table);
		            }, 0);
		        },
		        ondblClickRow: function(rowid) {     	            	            
		            var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');                                              
	            	var ret = jQuery(grid_selector).jqGrid('getRowData',gsr);

	            	$('#txt_id').val(ret.id);	            	
	            	$('#txt_2').val(ret.usuario);
	            	$('#txt_1').val(ret.nombres);
	            	$('#txt_4').val(ret.apellidos);
	            	$('#txt_7').val(ret.direccion);	            		            	
	            	$("#select_nivel").select2('val', ret.cargo).trigger("change");
	            	$('#txt_5').val(ret.correo);
	            	$("#select_genero").select2('val', ret.genero).trigger("change");
					$('#txt_3').val(ret.clave);
					$('#txt_6').val(ret.clave);
	            	$('#temp').attr("src","data/user/images/"+ret.imagen);
		            $('#txt_3').attr('disabled',true);
		            $('#txt_6').attr('disabled',true);
		            $('#myModal').modal('hide'); 
		            $('#btn_0').attr('disabled', true); 
		            $('#btn_3').attr('disabled', false); 	
	            	            
		        },
		        
		        caption: "LISTA USUARIOS"
		    });
	
		    $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto

		    function aceSwitch( cellvalue, options, cell ) {
		        setTimeout(function(){
		            $(cell) .find('input[type=checkbox]')
		            .addClass('ace ace-switch ace-switch-5')
		            .after('<span class="lbl"></span>');
		        }, 0);
		    }	    	   

		    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
		    {   
		        edit: false,
		        editicon : 'ace-icon fa fa-pencil blue',
		        add: false,
		        addicon : 'ace-icon fa fa-plus-circle purple',
		        del: false,
		        delicon : 'ace-icon fa fa-trash-o red',
		        search: true,
		        searchicon : 'ace-icon fa fa-search orange',
		        refresh: true,
		        refreshicon : 'ace-icon fa fa-refresh green',
		        view: true,
		        viewicon : 'ace-icon fa fa-search-plus grey'
		    },
		    {	        
		        recreateForm: true,
		        beforeShowForm : function(e) {
		            var form = $(e[0]);
		            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
		            style_edit_form(form);
		        }
		    },
		    {
		        closeAfterAdd: true,
		        recreateForm: true,
		        viewPagerButtons: false,
		        beforeShowForm : function(e) {
		            var form = $(e[0]);
		            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
		            .wrapInner('<div class="widget-header" />')
		            style_edit_form(form);
		        }
		    },
		    {
		        recreateForm: true,
		        beforeShowForm : function(e) {
		            var form = $(e[0]);
		            if(form.data('styled')) return false;      
		            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
		            style_delete_form(form); 
		            form.data('styled', true);
		        },
		        onClick : function(e) {}
		    },
		    {
		        recreateForm: true,
		        afterShowSearch: function(e){
		            var form = $(e[0]);
		            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
		            style_search_form(form);
		        },
		        afterRedraw: function(){
		            style_search_filters($(this));
		        },

		        //multipleSearch: true
		        overlay: false,
		        sopt: ['eq', 'cn'],
	            defaultSearch: 'eq',            	       
		      },
		    {
		        //view record form
		        recreateForm: true,
		        beforeShowForm: function(e){
		            var form = $(e[0]);
		            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
		        }
		    })	    
		    function style_edit_form(form) {
		        form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
		        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');

		        //update buttons classes
		        var buttons = form.next().find('.EditButton .fm-button');
		        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
		        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
		        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
		        
		        buttons = form.next().find('.navButton a');
		        buttons.find('.ui-icon').hide();
		        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
		        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');       
		    }

		    function style_delete_form(form) {
		        var buttons = form.next().find('.EditButton .fm-button');
		        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
		        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
		        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
		    }
		    
		    function style_search_filters(form) {
		        form.find('.delete-rule').val('X');
		        form.find('.add-rule').addClass('btn btn-xs btn-primary');
		        form.find('.add-group').addClass('btn btn-xs btn-success');
		        form.find('.delete-group').addClass('btn btn-xs btn-danger');
		    }
		    function style_search_form(form) {
		        var dialog = form.closest('.ui-jqdialog');
		        var buttons = dialog.find('.EditTable')
		        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
		        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
		        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
		    }
		    
		    function beforeDeleteCallback(e) {
		        var form = $(e[0]);
		        if(form.data('styled')) return false; 
		        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
		        style_delete_form(form);
		        form.data('styled', true);
		    }
		    
		    function beforeEditCallback(e) {
		        var form = $(e[0]);
		        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
		        style_edit_form(form);
		    }

		    function styleCheckbox(table) {}
		    
		    function updateActionIcons(table) {}
		    
		    function updatePagerIcons(table) {
		        var replacement = 
		            {
		            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
		            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
		            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
		            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
		        };
		        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
		            var icon = $(this);
		            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
		            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
		        })
		    }

		    function enableTooltips(table) {
		        $('.navtable .ui-pg-button').tooltip({container:'body'});
		        $(table).find('.ui-pg-div').tooltip({container:'body'});
		    }

		    $(document).one('ajaxloadstart.page', function(e) {
		        $(grid_selector).jqGrid('GridUnload');
		        $('.ui-jqdialog').remove();
		    });
		});
		// fin
	});
});