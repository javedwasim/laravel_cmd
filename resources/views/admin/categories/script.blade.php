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
    </script>
@endsection