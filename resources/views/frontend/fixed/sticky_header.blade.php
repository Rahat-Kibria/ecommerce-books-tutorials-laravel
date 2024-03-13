<div class="sticky-init fixed-header common-sticky">
    <div class="container d-none d-lg-block">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <a href="{{ route('botu') }}" class="site-brand">
                    <img src="{{ url('/frontend/image/books-tutorials-logo.png') }}" alt="Books and Tutorials Logo">
                </a>
            </div>
            <div class="col-lg-8">
                <div class="main-navigation flex-lg-right">
                    <ul class="main-menu menu-right ">
                        {{-- Books --}}
                        <li class="menu-item has-children">
                            <a href="javascript:void(0)">Books <i class="fas fa-chevron-down dropdown-arrow"></i></a>
                            <ul class="sub-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->children[0]->name) --}}
                                    <li class="has-children">
                                        <a
                                            href="{{ route('botu.products.list.books', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if ($rootCategory->children->isNotEmpty())
                                            <ul class="sub-menu" style="top: 0; left: 80%">
                                                @foreach ($rootCategory->children as $child)
                                                    <li class="has-children">
                                                        <a
                                                            href="{{ route('botu.products.list.books', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if ($child->children->isNotEmpty())
                                                            <ul class="sub-menu" style="top: 0; left: 80%">
                                                                @foreach ($child->children as $ch)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('botu.products.list.books', [$ch->id, $ch->slug]) }}">{{ $ch->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- Tutorials --}}
                        <li class="menu-item has-children">
                            <a href="javascript:void(0)">Tutorials <i
                                    class="fas fa-chevron-down dropdown-arrow"></i></a>
                            <ul class="sub-menu">
                                @foreach ($rootCategories as $rootCategory)
                                    {{-- @dd($rootCategory->children[0]->name) --}}
                                    <li class="has-children">
                                        <a
                                            href="{{ route('botu.products.list.tutorials', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}</a>
                                        @if ($rootCategory->children->isNotEmpty())
                                            <ul class="sub-menu" style="top: 0; left: 80%">
                                                @foreach ($rootCategory->children as $child)
                                                    <li class="has-children">
                                                        <a
                                                            href="{{ route('botu.products.list.tutorials', [$child->id, $child->slug]) }}">{{ $child->name }}</a>
                                                        @if ($child->children->isNotEmpty())
                                                            <ul class="sub-menu" style="top: 0; left: 80%">
                                                                @foreach ($child->children as $ch)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('botu.products.list.tutorials', [$ch->id, $ch->slug]) }}">{{ $ch->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- Blog --}}
                        <li class="menu-item"><a href="{{ route('botu.blog.home') }}">Blog</a></li>
                        {{-- Contact --}}
                        <li class="menu-item">
                            <a href="{{ route('botu.contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
