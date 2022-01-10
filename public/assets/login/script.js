$(document).ready(function()
{
    $(document).on('submit','form',function()
    {
        $(this).find('button').prop('disabled',true)
    })
})