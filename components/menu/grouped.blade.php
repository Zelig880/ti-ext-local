<div class="menu-group">
    @if (!count($groupedMenuItems))
        <div class="menu-group-item">
            <p>@lang('igniter.local::default.text_no_category')</p>
        </div>
    @else
        @foreach ($groupedMenuItems as $categoryId => $menuList)
            <div class="menu-group-item">
                @if ($categoryId > 0)
                    @php
                        $menuCategory = array_get($menuListCategories, $categoryId);
                        $menuCategoryAlias = strtolower(str_slug($menuCategory->name));
                    @endphp
                    <div id="category-{{ $menuCategoryAlias }}-heading" role="tab">
                        <h4
                            class="category-title cursor-pointer {{ $loop->iteration >= 5 ? 'collapsed' : '' }}"
                            data-toggle="collapse"
                            data-target="#category-{{ $menuCategoryAlias }}-collapse"
                            aria-expanded="false"
                            aria-controls="category-{{ $menuCategoryAlias }}-heading"
                        >{{ $menuCategory->name }}<span class="collapse-toggle text-muted pull-right"></span></h4>
                    </div>
                    <div
                        id="category-{{ $menuCategoryAlias }}-collapse"
                        class="collapse {{ $loop->iteration < 5 ? 'show' : '' }}"
                        role="tabpanel" aria-labelledby="{{ $menuCategoryAlias }}"
                    >
                        <div class="menu-category">
                            @if (strlen($menuCategory->description))
                                <p>{!! nl2br($menuCategory->description) !!}</p>
                            @endif

                            @if ($menuCategory->hasMedia('thumb'))
                                <div class="image">
                                    <img
                                        class="img-responsive"
                                        src="{{ $menuCategory->getThumb(['width' => $menuCategoryWidth, 'height' => $menuCategoryHeight]) }}"
                                        alt="{{ $menuCategory->name }}"
                                    />
                                </div>
                            @endif
                        </div>

                        @partial('@items', ['menuItems' => $menuList])
                    </div>
                @else
                    @partial('@items', ['menuItems' => $menuList])
                @endif
            </div>
        @endforeach
    @endif
</div>
