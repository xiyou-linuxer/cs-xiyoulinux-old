$(document).ready(function() {
        $('#bt_search').click(function() {
                if($('#searchinf').val() != "")
                {
                        location.href = 'search.php?wd=' + $('#searchinf').val();
                        var param = {
                                search_html: $('#searchinf').val()
                        };
                        
                        $.post('test.php', param, function() {
                                
                        });
                        }
                        return false;
                                        });
                });

