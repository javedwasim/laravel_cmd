@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
        $('#title').on('blur',function () {
            var theTitle = this.value.toLowerCase().trim(),
                slugInout = $('#slug'),
                theSlug = theTitle.replace(/&/g,'-and-')
                    .replace(/[^a-z0-9-]+/g,'-')
                    .replace(/\-\-+/g,'-')
                    .replace(/^-+|-+$/g,'');
            slugInout.val(theSlug);
        });
        var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format:'YYYY-MM-DD HH:mm:ss',
                showClear:true,
            });
        });
        $('#draft-btn').click(function (e) {
            e.preventDefault();
            $('#published_at').val("");
            $("#post-form").submit();
        });
    </script>
@endsection