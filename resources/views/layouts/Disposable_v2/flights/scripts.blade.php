@section('scripts')
  <script>
    $(document).ready(function () {
      $("button.save_flight").click(async function (e) {
        e.preventDefault();

        const btn = $(this);
        const class_name = btn.attr('x-saved-class'); // classname to use is set on the element
        const flight_id = btn.attr('x-id');

        if (!btn.hasClass(class_name)) {
          await phpvms.bids.addBid(flight_id);

          console.log('successfully saved flight');
          btn.addClass(class_name);
          alert('@lang("flights.bidadded")');
          window.location = "{{ route('frontend.flights.bids') }}";
        } else {
          await phpvms.bids.removeBid(flight_id);

          console.log('successfully removed flight');
          btn.removeClass(class_name);
          alert('@lang("flights.bidremoved")');
          window.location = "{{ route('frontend.flights.index') }}";
        }
      });
    });
  </script>
@endsection
