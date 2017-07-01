<div class="row">
    <nav aria-label="Page navigation" class="{{ $class }} col-xs-12">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $limit; $i++)
                <li>
                    <a href="{{ $url }} / {{ $i }}">{{ $i }}</a>
                </li>
            @endfor
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
