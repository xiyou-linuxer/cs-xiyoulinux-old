$(document).ready(function() {
        $('#bt_search').click(function() {
                if($('#search_inf').val() != "")
                {
                        location.href = 'search.php?wd=' + $('#search_inf').val();
                    
                        }
                        return false;
                                        });
                });

