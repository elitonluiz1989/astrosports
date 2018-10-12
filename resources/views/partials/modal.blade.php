@php
    $modalClass = 'modal fade';

    if (isset($customClass)) {
        $modalClass .= ' '. $customClass;
    }

    $ariaLabel = $ariaLabel ?? 'Fechar';

@endphp

<div id="{{ $modalId }}" class="{{ $modalClass }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="{{ $ariaLabel }}">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                @include('partials.mask', ['maskType' => 'mask--light'])

                {{ $slot }}
            </div>
        </div>
    </div>
</div>