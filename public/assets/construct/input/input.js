function changeSelect(input,data)
{
    if($.isArray(data))
    {
        input=$(input).find('.input-select');
        var option=input.find('.option > div').removeClass('active')
        option.find('input').prop('checked',false)
        $.each(data,function(i,data){
            option.find("input[value='"+data+"']").prop('checked',true).parent().addClass('active')
        })
        input.find('> p').html(input.find('.option div.active').length+' مورد انتخاب شده')
    }else{
        input.find('> p').html(input.find('.option span[value='+data+']').clone().children().remove().end().text())
        input.find('.menu > input').val(input.find('.option span[value='+data+']').attr('value'))
    }
}
$(document).ready(function()
{
    $.fn.inputMask=function()
    {
        var element=$(this)

        var inputMask={
            type: element.attr('mask-type'),
            options: [''],
            attr: '',

            getAttr: function($node,except='')
            {
                inputMask.attr=''
                $.each($node[0].attributes,function(index,attribute){
                    if(attribute.name==except) return false;
                    inputMask.attr=inputMask.attr+' '+attribute.name+"='"+attribute.value+"'"
                });
            },
            searchIn: function(input,targets,closest='')
            {
                var filter=input.val().trim()
                targets.each(function()
                {
                    var element=closest!='' ? $(this).closest(closest) : $(this)
                    if($(this).text().search(new RegExp(filter,'i'))<0) element.hide(); else element.show();
                })
            },
            randomText: function()
            {
                return Math.random().toString(36).substr(3).toLocaleUpperCase();
            },
            currency: function(value)
            {
                var result=value.split(',').join('');
                var result=result=='' ? '' : Number(result);
                return !isNaN(result) ? result.toLocaleString() : ''
            }
        }

        // Start get options and type
        if(typeof inputMask.type=='undefined') return false;
        inputMask.type=inputMask.type.split(':')
        inputMask.options=inputMask.type[1]==undefined || inputMask.type[1]=='' ? [''] : inputMask.type[1].split(',');
        inputMask.type=inputMask.type[0]
        element.removeAttr('mask-type')


        // Start input label
        if(element.is('[mask-label]'))
        {
            var label=$(this).attr('mask-label');
            label=($(this).hasClass('required') ? '<i class="fas fa-star-of-life"></i>' : '')+label;
            $(this).prepend(
                ""+
                "<div class='input-label'>"+
                "   <p>"+label+"</p>"+
                "</div>"
            )
            $(this).removeAttr('mask-label')
        }

        // Start switch mask type
        switch(inputMask.type)
        {
            case 'select':
                var select=element.find('select')
                var option=select.find('option')
                var selected=false
                inputMask.getAttr(select)

                element.append(
                    "" +
                    "<div class='input-select'>"+
                    "   <i class='fal fa-chevron-down'></i>"+
                    "   <p> -- هیچ موردی انتخاب نشده -- </p>"+
                    "   <div class='menu'>"+
                    ($.inArray('search',inputMask.options)!==-1 ? "<div class='search'><input type='text' placeholder='جست و جو ...'></div>" : "")+
                    "       <div class='option'></div>"+($.inArray('multi',inputMask.options)===-1 ? "<input type='text'"+inputMask.attr+">" : "")+
                    "   </div>" +
                    "</div>"
                )

                if(option.length>0)
                {
                    option.each(function()
                    {
                        if($(this).attr('selected')!=undefined)
                        {
                            if($.inArray('multi',inputMask.options)===-1)
                            {
                                selected=$(this).attr('value');
                            }else{
                                if(selected==false) selected=[];
                                selected.push($(this))
                            }
                        }
                        var string=$.inArray('multi',inputMask.options)!==-1 ?
                            "<div>"+
                            ($(this).attr('tool-bar')!==undefined ? "<p class='tool-bar'>"+$(this).attr('tool-bar')+"</p>" : "")+
                            "<p>"+$(this).html()+"</p>"+
                            "<span></span>"+
                            "<input type='checkbox' value='"+$(this).val()+"' "+inputMask.attr+">"+
                            "</div>" :
                            "<span value='"+$(this).val()+"'>"+
                            ($(this).attr('tool-bar')!==undefined ? "<p class='tool-bar'>"+$(this).attr('tool-bar')+"</p>" : "")+
                            $(this).html()+
                            "</span>"
                        element.find('.menu .option').append(string)
                    })
                }else{
                    element.find('.menu .option').append("<p> -- موردی برای نمایش وجود ندارد -- </p>")
                }
                select.remove();
                select=element.find('.input-select')

                if($.inArray('multi',inputMask.options)===-1)
                {
                    element.find('.search input').on('keyup',function(){inputMask.searchIn($(this),element.find('.menu .option span'))})
                    element.click(function(){
                        select.toggleClass('active')
                    }).on('click','.menu',function(e){
                        e.stopPropagation()
                    })
                    option=select.find('.menu .option span')
                    option.click(function(){
                        select.find('> p').html($(this).clone().children().remove().end().text())
                        select.find('.menu > input').val($(this).attr('value'))
                        $(this).closest('.input-select').removeClass('active')
                    })
                }else{
                    element.find('.search input').on('keyup',function(){inputMask.searchIn($(this),element.find('.menu .option div p'),'div')})
                    element.click(function(){
                        select.addClass('active')
                    })
                    option=select.find('.menu .option div')
                    option.click(function()
                    {
                        var input=$(this).find('input')
                        if(input.is(':checked'))
                        {
                            input.prop('checked',false)
                            $(this).removeClass('active')
                        }else{
                            input.prop('checked',true)
                            $(this).addClass('active')
                        };
                        var ln=option.find('input:checked').siblings('p:not(.tool-bar)').length
                        select.find('> p').html(
                            ln > 0 ? ln+" مورد انتخاب شده " : '-- هیچ موردی انتخاب نشده --'
                        )
                    })
                }

                $('body,html').click(function(e){
                    if(!select.is(e.target) && select.has(e.target).length===0) select.removeClass('active');
                })

                if(selected!==false)
                {
                    if($.inArray('multi',inputMask.options)===-1) changeSelect(select,selected);else{
                        for(var i=0;i<selected.length;i++)
                        {
                            var thisSelected=selected[i]
                            element.find(".menu div input[value='"+thisSelected.val()+"']").prop('checked',true).closest('div').addClass('active');
                        }
                        select.find('> p').html(selected.length+' مورد انتخاب شده')
                    }
                }
                break;
            case 'radio':
                var input=element.find('input[type=radio]')
                input.remove()

                element.append("<div class='radio'></div>")
                var radio=element.find('.radio')

                input.each(function(){
                    var label=$(this).attr('label')
                    var id=inputMask.randomText()
                    var checked=$(this).attr('checked') ? 'active' : ''
                    if(label==undefined || label=='') label='عنوان برچسب'
                    inputMask.getAttr($(this))
                    radio.append(
                        "<div class='item "+checked+"'>"+
                        "    <label for='"+id+"'>"+
                        "       <span></span>"+
                        "       <p>"+label+"</p>"+
                        "    </label>"+
                        "    <input type='radio'"+inputMask.attr+" id='"+id+"'>"+
                        "</div>"
                    )
                })
                input=element.find('input[type=radio]')

                input.on('change',function()
                {
                    $("input[name='"+$(this).attr('name')+"']").prop('checked',false).closest('.item').removeClass('active')
                    $(this).prop('checked',true).closest('.item').addClass('active')
                })
                break;
            case 'checkbox':
                var input=element.find('input[type=checkbox]')
                input.remove()

                element.append("<div class='checkbox'></div>")
                var checkbox=element.find('.checkbox')

                input.each(function(){
                    var label=$(this).attr('label')
                    var id=inputMask.randomText()
                    var checked=$(this).attr('checked') ? 'active' : ''
                    if(label==undefined || label=='') label='عنوان برچسب'
                    inputMask.getAttr($(this))
                    checkbox.append(
                        "<div class='item "+checked+"'>"+
                        "    <label for='"+id+"'>"+
                        "<span></span>"+
                        "<p>"+label+"</p>"+
                        "    </label>"+
                        "    <input type='checkbox'"+inputMask.attr+" id='"+id+"'>"+
                        "</div>"
                    )
                })
                input=element.find('input[type=checkbox]')

                input.on('change',function(){
                    if($(this).is(':checked'))
                    {
                        $(this).prop('checked',true).closest('.item').addClass('active')
                    }else{
                        $(this).prop('checked',false).closest('.item').removeClass('active')
                    }
                })

                break;
            case 'currency':
                var currencyElement=element.find('input[type=text]')
                currencyElement.val(inputMask.currency(currencyElement.val()))
                currencyElement.on('keyup',function(){
                    $(this).val(inputMask.currency($(this).val()))
                })
                break;
            case 'upload':
                var input=element.find('input[type=file]');
                var multiple=input.attr('multiple')===undefined ? false : true;
                var nameAttr=input.attr('name')
                input.removeAttr('name')
                var selectedFile=null;
                element.append(
                    "<div class='upload'>"+
                    "    <div class='drop-zone'>"+
                    "        <div class='body'>"+
                    "            <i class='fal fa-cloud-upload'></i>"+
                    "            <p> پیوست را اینجا رها کنید و یا کلیک کنید </p>"+
                    "            <div class='info'>"+
                    "                <p><span>"+inputMask.options[0]+"</span> :حداکثر حجم فایل </p>"+
                    "                <p><span>"+inputMask.options[1]+"</span> :فرمت های مجاز </p>"+
                    "            </div>"+
                    "        </div>"+
                    "    </div>"+
                    "    <div class='list'>"+
                    "        <ul></ul>"+
                    "    </div>"+
                    "</div>"
                );
                input.appendTo(element.find('.upload'))
                var dropZone=element.find('.drop-zone')
                var filesList=element.find('.list ul')

                var draggingStatus=0
                $(dropZone).on({
                    dragenter:function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).parent().addClass('active')
                        draggingStatus++
                    },
                    dragleave:function(){
                        draggingStatus--
                        if(draggingStatus==0) $(this).parent().removeClass('active')
                    },
                    dragover:function(e){
                        e.preventDefault()
                    },
                    drop:function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).parent().removeClass('active')
                        draggingStatus--
                        addFile(e.originalEvent.dataTransfer.files);
                    },
                    click:function()
                    {
                        input.click()
                    }
                })
                input.on('change',function(){if(input.val()!='') addFile(input[0].files)})
                function addFile(selectedFile)
                {
                    var name=selectedFile[0].name
                    var size=selectedFile[0].size
                    if(multiple===false && selectedFile.length>1) return false;
                    if(selectedFile.length>1)
                    {
                        for(i=1;i<selectedFile.length;i++)
                        {
                            name+=','+selectedFile[i].name
                            size+=selectedFile[i].size
                        }
                    }
                    var content="<li><div><p>"+name+"</p></div><div><i class='far fa-times discard'></i><span>"+(size/1024/1024).toFixed(3)+"MB</span></div><input type='file' name='"+nameAttr+"'></li>"
                    if(multiple) filesList.append(content)
                    else filesList.html(content)
                    filesList.find("li:last-child input[type='file']").prop('files',selectedFile)
                    filesList.parent().addClass('active')
                }
                filesList.on('click','li .discard',function()
                {
                    $(this).closest('li').remove()
                    if(filesList.find('li').length==0) filesList.parent().removeClass('active')
                })
                break;
            case 'switcher':
                var input=element.find('input[type=checkbox]')
                input.remove()

                element.append("<div class='switcher'></div>")
                var switcher=element.find('.switcher')

                input.each(function(){
                    var label=$(this).attr('label')
                    var id=inputMask.randomText()
                    var checked=$(this).attr('checked') ? 'active' : ''
                    inputMask.getAttr($(this))
                    switcher.append(
                        "<div class='item "+checked+"'>"+
                        "    <label for='"+id+"'>"+
                        "       <span></span>"+
                        "    </label>"+
                        "    <input type='checkbox'"+inputMask.attr+" id='"+id+"'>"+
                        "</div>"
                    )
                })
                input=element.find('input[type=checkbox]')

                input.on('change',function(){
                    if($(this).is(':checked'))
                    {
                        $(this).prop('checked',true).closest('.item').addClass('active')
                    }else{
                        $(this).prop('checked',false).closest('.item').removeClass('active')
                    }
                })
                break;
            case 'tag':
                element.append("<div class='tag'><ul></ul></div>")
                var tagList=element.find('.tag ul')
                var input=element.find('input[type=text]')
                inputMask.getAttr(input,'value')
                if(input.val()!='')
                {
                    var a=$.parseJSON(input.val())
                    input.removeAttr('value')
                    for(var i=0;i<a.length;i++)
                    {
                        tagList.append(
                            "<li>" +
                            "   <i class='far fa-times'></i>"+
                            "   <span>"+a[i]+"</span>" +
                            "   <input type='text'"+inputMask.attr+" value='"+a[i]+"'>"+
                            "</li>"
                        )
                    }
                }
                input.removeAttr('name')
                input.on('keyup',function(e)
                {
                    var a=input.val()
                    var check=a.substr(a.length-2,a.length)
                    if(check=='  ' && a.trim()!='')
                    {
                        tagList.append(
                            "<li>" +
                            "   <i class='far fa-times'></i>"+
                            "   <span>"+a.trim()+"</span>" +
                            "   <input type='text' "+inputMask.attr+" value='"+a.trim()+"' >"+
                            "</li>"
                        )
                        input.val('')
                    }
                })
                input.on('focusout',function(e)
                {
                    var a=input.val()
                    if(a.trim()!='')
                    {
                        tagList.append(
                            "<li>" +
                            "   <i class='far fa-times'></i>"+
                            "   <span>"+a.trim()+"</span>" +
                            "   <input type='text' "+inputMask.attr+" value='"+a.trim()+"' >"+
                            "</li>"
                        )
                        input.val('')
                    }
                })
                tagList.on('click','li',function()
                {
                    $(this).remove();
                })
                break;
        }
    }

    $('.input-mask').each(function(){
        $(this).inputMask();
    })
})