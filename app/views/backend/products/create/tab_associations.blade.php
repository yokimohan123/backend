<h3 class="box-title">Product Association</h3>
{{ Form::model($product, ['route' => ['backend.products.association',$product->id], 'method' => 'patch']) }}

<ul>
    <?php foreach($tree as $parent){ ?>
        <li>
            <input type="radio" name="category[parent]" value="{{$parent['id']}}" /> {{$parent['name']}}
            <?php if(isset($parent['children'])){ ?>
            <ul>
                <?php foreach($parent['children'] as $firstchild) { ?>
                    <li>
                        <input type="radio" name="category[category]" value="{{$firstchild['id']}}" /> {{$firstchild['name']}}
                        <?php if(isset($firstchild['children'])) { ?>
                            <ul>
                                <?php foreach($firstchild['children'] as $secondchild) { ?>
                                <li>
                                    <input type="radio" name="category[child]" value="{{$secondchild['id']}}" /> {{$secondchild['name']}}
                                </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
    <?php } ?>
</ul>
<button type="submit" class="btn btn-success">Submit</button>
{{ Form::close() }}