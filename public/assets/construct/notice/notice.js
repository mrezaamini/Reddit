$(document).ready(function()
{
    $.notice=function(message,type,element=$('.notice'),hide=false)
    {
        element=element.first();
        if($.inArray(type,['danger','success','warning'])===-1) type='primary'
        element.addClass(type)
        element.html('<ul></ul>')
        if(!$.isArray(message) && typeof message!='object') message=[message]
        $.each(message,function(key,val)
        {
            element.find('ul').append(
                '<li>'+val+'</li>'
            )
        })
        element.fadeIn(350)

        if(hide)
        {
            setTimeout(function()
            {
                element.fadeOut(350)
            },2500)
        }
    }
})