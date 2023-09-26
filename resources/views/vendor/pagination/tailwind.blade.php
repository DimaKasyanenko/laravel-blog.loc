@if ($paginator->hasPages())
    <nav class="mt-4">
        <ul class="flex flex-wrap items-center justify-center gap-3">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                        <span
                                            class="block p-3 text-sm font-black leading-none text-pink">{{ $page }}</span>
                                    </span>
                        @else
                            <a href="{{ $url }}"
                               class="block p-3 text-sm font-black leading-none text-white hover:text-pink"
                               aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
