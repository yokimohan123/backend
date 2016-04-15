@include('partials.header')
@section('content')



<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}/">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/designer">Designer</a>
                    </li>
                </ul>
            </div>
            <?php foreach ($designers as $design) { ?>
            <div class="designer-shot">
                <img src="{{URL::to('/')}}/images/<?php echo $design['image']; ?>" alt="Designer">
            </div>
            <div class="designer-about">
                <p><?php echo $design['content']; ?></p>
            </div>
            <?php } ?>
</div>


@include('partials.footer')