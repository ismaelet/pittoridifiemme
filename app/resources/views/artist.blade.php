<x-layouts.main :title="$artist->full_name">
    @push('assets')
        @vite('resources/css/pages/artist.css')
    @endpush

    @php
        $biography = $artist->biographyUrl();
        $previousUrl = url('/artist?id='.$artist->ID.'&imgID='.$previous->ID);
        $nextUrl = url('/artist?id='.$artist->ID.'&imgID='.$next->ID);
    @endphp

    <div id="body">
        <div
            id="bgr"
            class="bgr"
        ></div>

        <div
            id="artist-grid"
            class="grid"
        >
            {{-- Image --}}
            <section
                id="img-sec"
                class="grid just-cen"
            >
                <div id="img-box">
                    <img
                        id="img"
                        class="load ld-bot ld-del3"
                        src="{{ $current->largeUrl() }}"
                        alt="{{ $artist->full_name }}"
                    >

                    <a
                        id="arrow1"
                        class="arrow img cont cenX"
                        style="background-image: url({{ Vite::asset('resources/images/icons/navigation/nav1_top_blk.png') }});"
                        href="{{ $previousUrl }}"
                    ></a>
                    <a
                        id="arrow2"
                        class="arrow img cont cenX"
                        style="background-image: url({{ Vite::asset('resources/images/icons/navigation/nav1_bot_blk.png') }});"
                        href="{{ $nextUrl }}"
                    ></a>
                </div>
            </section>

            {{-- Artist data --}}
            <section id="artist-sec">
                <h1 id="title">{{ $artist->full_name }}</h1>

                <h1
                    id="date"
                    class="txt-light"
                >{{ $artist->details }}</h1>

                @if ($biography)
                    <a href="{{ $biography }}">
                        <p
                            id="desc"
                            class="c1_txt_h"
                        >Biografia dell'artista</p>
                    </a>
                @endif

                <p
                    id="nav"
                    class="mart2"
                >
                    <a
                        href="{{ $previousUrl }}"
                        class="txt-blk-h"
                    >Precedente</a>
                    /
                    <a
                        href="{{ $nextUrl }}"
                        class="txt-blk-h"
                    >Successivo</a>

                    <span class="nav_numb">({{ $position }} di {{ $count }})</span>
                </p>
            </section>
        </div>

        {{-- Gallery --}}
        <div
            id="gallery"
            class="grid5 grid4-768w grid3-550w grid-pad1 mart1 padb4"
        >
            @foreach ($images as $image)
                <div class="imgM-box">
                    <a
                        class="imgM bgr"
                        href="{{ url('/artist?id='.$artist->ID.'&imgID='.$image->ID) }}"
                        style="background-image: url({{ $image->mediumUrl() }});"
                    ></a>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.main>
