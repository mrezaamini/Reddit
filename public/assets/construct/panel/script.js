$(document).ready(function()
{
    // Disable form button
    $(document).on('submit','form:not([no-disabled])',function()
    {
        $(this).find('button').prop('disabled',true)
    })

    // Start menu dropdown
    $('aside .menu ul .dropdown .item').slideUp(0)
    $('aside .menu ul:not(.disabled) .dropdown .text').click(function()
    {
        var dropdown=$(this).closest('.dropdown')

        $('aside .menu ul .dropdown').not(dropdown).removeClass('active').find('.item').slideUp(200)
        if(!dropdown.hasClass('active')) dropdown.addClass('active').find('.item').slideDown(200)
        else dropdown.removeClass('active').find('.item').slideUp(200)
    })
    $('aside .menu ul.disabled a').click(function(e){e.preventDefault()})

    // Start block dropdown
    $('.block .body ul.dropdown li:not(.active) > .item').slideUp(0)
    $('.block .body ul.dropdown li > .title').click(function()
    {
        if($(this).closest('li').hasClass('active')) $(this).closest('li').removeClass('active').find('> .item').slideUp(350)
        else{
            $('.block .body ul.dropdown li').removeClass('active').find('> .item').slideUp(350)
            $(this).closest('li').addClass('active').find('> .item').slideDown(350)
        }
    })

    // Start header toolbar
    function activeHeaderDropdown(item)
    {
        item.stop().fadeIn(300)
        item.closest('.dropdown').addClass('active')
    }
    function deactiveHeaderDropdown(item)
    {
        item.stop().fadeOut(300)
        item.closest('.dropdown').removeClass('active')
    }
    $('header .tool-bar .dropdown .item').fadeOut(0)
    $('header .tool-bar .dropdown').on('click',function(e){e.stopPropagation()})
    $('header .tool-bar .dropdown .icon').click(function()
    {
        var target=$(this).closest('.dropdown').find('.item');
        deactiveHeaderDropdown($('header .tool-bar .dropdown .item'))
        setTimeout(function()
        {
            activeHeaderDropdown(target)
        },0)
    })
    $('header .tool-bar .dropdown .item .header .close').click(function(){deactiveHeaderDropdown($(this).closest('.dropdown').find('.item'))})
    $(document).on('click',function(){deactiveHeaderDropdown($('header .tool-bar .dropdown .item'))})
    $(document).on('keydown','body',function(e){if(e.keyCode==27) deactiveHeaderDropdown($('header .tool-bar .dropdown .item'))})

    // Start change avatar
    $('aside .profile .avatar .change-avatar .icon').click(function()
    {
        $('form#change-avatar').find("input[type='file']").click()
    })
    $("form#change-avatar input[type='file']").on('change',function()
    {
        $('form#change-avatar').submit();
    })

    // Start aside menu
    $('.aside-menu li').each(function()
    {
        if($(this).find('a').attr('href')==window.location.pathname) $(this).addClass('active')
    })

    // Start copy to clipboard
    $('.copy-to-clipboard').click(function()
    {
        var input=$('<input>');
        $('body').append(input);
        input.val($(this).attr('text')).select();
        document.execCommand('copy');
        input.remove();
    })

    // Remove preloader
    $('.pre-load').remove()
});
