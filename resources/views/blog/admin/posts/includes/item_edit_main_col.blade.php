@php
    /** @var \App\Models\Blog\BlogPost $item */
    /** @var \Illuminate\Database\Eloquent\Collection $categoryList */
@endphp
<div class="row justify-content-center mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle md-2 text-muted"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="list" href="#maindata" role="tab" aria-controls="maindata">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="list" href="#adddata" role="tab" aria-controls="adddata">Дополнительные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ old('title', $item->title) }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      class="form-control"
                                      rows="22"
                            >{{ old('content_raw', $item->content_raw) }}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == old('category_id', $item->category_id) ) selected @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Индентификатор</label>
                            <input name="slug" value="{{ old('slug', $item->slug) }}"
                                   id="slug"
                                   type="text"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <input name="excerpt" value="{{ old('excerpt', $item->excerpt) }}"
                                   id="excerpt"
                                   type="text"
                                   class="form-control">
                        </div>
                        <div class="form-check mt-2">
                            <input  name="is_published"
                                    type="hidden"
                                    value="0">
                            <input  name="is_published"
                                    type="checkbox"
                                    class="form-check-input"
                                    value="1"
                                    @if(old('is_published', $item->is_published))
                                    checked="checked"
                                    @endif
                            >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
