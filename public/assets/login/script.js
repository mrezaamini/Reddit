$(document).ready(function()
{
    $(document).on('submit','form',function()
    {
        $(this).find('button').prop('disabled',true)
    })

    $(document).on('mousedown','.show-password',function()
    {
        $("input[name='password']").attr('type','text')
    })
    $(document).on('mouseup','.show-password',function()
    {
        $("input[name='password']").attr('type','password')
    })
})