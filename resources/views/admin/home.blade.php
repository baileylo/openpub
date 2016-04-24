@extends('admin.layouts.master')

@section('content')
    <section class="col-lg-12">
        <hr>
        <div class="row">
            <div class="col-sm-8"><h2>Lighweight</h2><p>The new Bootstrap 3 is a smaller build. The separate Bootstrap
                    base and responsive.css files have now been merged into one. There is no
                    more fixed grid, only fluid.</p></div>
            <div class="col-sm-4"><img class="img-responsive" src="//placehold.it/220x180/666666/FFF"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-4"><img class="img-responsive" src="//placehold.it/220x180/777777/FFF"></div>
            <div class="col-sm-8"><h2>Large, Small or Tiny</h2><p>
                    The new fluid grid comes in 3 flavors, or actually sizes. The large grid <code>col-lg-*</code> works exactly like the Bootstrap 2.x <code>span*</code> did.
                    There is also a small grid that is realized using the <code>col-sm-*</code> classes. This smaller grid is ideal for smartphones and tablets.
                    Finally, there is the non-stacking tiny grid <code>col-*</code> that is intended for very small screens less that 480px.
                </p></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-8"><h2>A Playground</h2><p>
                    Bootply is a playground for Bootstrap. Designers and developers use Bootply to edit, design, prototype, test and find examples that use Bootstrap 3.
                    Use Bootply to hand-code HTML, Javascript, CSS and drop in the Bootstrap classes. There is a also a visual drag-and-drop builder that is perfect for wire-framing and mockups.
                </p></div>
            <div class="col-sm-4"><img class="img-responsive" src="//placehold.it/220x180/777777/FFF"></div>
        </div>
        <hr>
    </section>
@endsection