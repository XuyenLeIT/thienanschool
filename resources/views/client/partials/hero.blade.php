<div class="hero-carousel">
    <div class="carousel"
        data-flickity='{
      "cellAlign": "center",
      "contain": true,
      "wrapAround": true,
      "autoPlay": 2000,
      "pageDots": true,
      "prevNextButtons": true,
      "groupCells": true
    }'>
        @foreach ($carausels as $item)
            <div class="carousel-cell">
                <div class="art-card">
                    <div class="art-card-image" style="background-image: url('{{ asset($item->image) }}');">
                        <div class="overlay">
                            <div class="text-content">
                                <h3>{{ $item->title }}</h3>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- CSS --}}
<style>
    .hero-carousel {
        background: linear-gradient(135deg, #f0f2f5 0%, #d9e2f0 100%);
        padding: 20px 0;
    }

    .carousel-cell {
        width: 550px;
        margin-right: 20px;
    }

    .art-card {
        border-radius: 1.5rem;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .art-card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .art-card-image {
        position: relative;
        width: 100%;
        height: 250px;
        background-size: cover;
        background-position: center;
    }

    .art-card-image .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* overlay nhẹ hơn */
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.15) 0%, rgba(0, 0, 0, 0.35) 100%);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        transition: background 0.3s;
    }

    .text-content h3 {
        color: #fff;
        font-size: 1.5rem;
        margin: 0 0 8px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
    }

    .text-content p {
        color: #f0f0f0;
        font-size: 1rem;
        margin: 0;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 991px) {
        .carousel-cell {
            width: 70%;
        }
    }

    @media (max-width: 767px) {
        .carousel-cell {
            width: 90%;
        }

        /* Ẩn description */
        .text-content p {
            display: none;
        }
    }
</style>
