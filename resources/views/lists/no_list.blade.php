@extends('layouts.app')

@section('content')
<style>
  *, *::before, *::after { box-sizing: border-box; }
  body {font-family: Arial, Helvetica, sans-serif;color: #222;background: #fff;font-size: 14px;}
  /* LAYOUT */
  .list-wrapper {max-width: 1400px;margin: 0 auto;padding: 32px 32px 80px;display: flex;gap: 40px;align-items: flex-start;}
  .list-main { flex: 1; min-width: 0; }
  /* TITLE */
  .list-title {font-size: 22px;font-weight: 700;margin-bottom: 18px;}
  .list-meta {display: flex;align-items: center;gap: 10px;margin-bottom: 22px;font-size: 13px;color: #444;}
  .list-meta a { color: #a100a0; text-decoration: none; }
  .list-meta a:hover { text-decoration: underline; }
  .avatar {width: 28px;height: 28px;background: #ddd;border-radius: 3px;display: inline-block;}
  /* DESCRIPTION */
  .desc-display {border: 1px transparent solid;min-height: 40px;padding: 10px 36px 10px 12px;font-size: 14px;margin-bottom: 18px;position: relative;cursor: pointer;transition: border-color .15s, background .15s;line-height: 1.5;}
  .desc-display:hover {border-color: #888;background: #fafafa;}
  .desc-display:hover .edit-icon { opacity: 1; }
  .edit-icon {position: absolute;right: 10px;top: 10px;opacity: 0;font-size: 15px;color: #555;transition: opacity .15s;pointer-events: none;}
  .desc-edit-area {display: none;margin-bottom: 18px;}
  .desc-edit-area textarea {width: 100%;min-height: 80px;border: 1px solid #666;padding: 10px;font-size: 14px;font-family: inherit;resize: vertical;outline: none;line-height: 1.5;}
  .desc-edit-area textarea:focus { border-color: #333; }
  .action-row {display: flex;gap: 10px;margin-top: 10px;}
  .btn-save {background: #222;color: #fff;border: none;padding: 10px 20px;font-size: 13px;cursor: pointer;border-radius: 2px;}
  .btn-cancel {background: #f0f0f0;border: 1px solid #ccc;padding: 10px 20px;font-size: 13px;cursor: pointer;border-radius: 2px;}
  /* TOOLBAR */
  .list-toolbar {display: flex;justify-content: space-between;align-items: center;margin: 22px 0 0;padding-bottom: 12px;border-bottom: 1px solid #eee;}
  .toolbar-left {display: flex;align-items: center;gap: 8px;font-size: 13px;}
  .pager-btn {width: 40px;height: 40px;border: 1px solid #d2d2d2;background: #fff;font-size: 16px;color: #888;cursor: pointer;display: flex;align-items: center;justify-content: center;}
  .pager-btn:hover { background: #f5f5f5; }
  .toolbar-right {display: flex;align-items: center;gap: 8px;font-size: 13px;}
  .show-select {
    width: 80px;
    height: 40px;
    border: 1px solid #d2d2d2;
    padding: 0 10px;
    font-size: 14px;
    background: #fff;
    cursor: pointer;
  }
  /* ITEM */
  .list-item {
    display: flex;
    gap: 24px;
    padding: 28px 0;
    border-bottom: 1px solid #eee;
    position: relative;
    align-items: flex-start;
  }
  .item-number {
    width: 28px;
    font-size: 14px;
    font-weight: 700;
    padding-top: 45px;
    flex-shrink: 0;
    color: #444;}
  .item-cover {flex-shrink: 0;}
  .item-cover img {width: 116px; height: 116px;object-fit: cover;border: 1px solid #ccc;display: block;}
  .item-content { flex: 1; min-width: 0; padding-top: 4px; }
  .item-title {
    font-size: 17px;
    font-weight: 700;
    color: #a100a0;
    text-decoration: none;
    display: block;
    margin-bottom: 2px;
    line-height: 1.2;
  }
  .item-title:hover { text-decoration: underline; }
  .item-artist {font-size: 15px;color: #a100a0;margin-bottom: 16px;cursor: pointer;}
  .item-artist:hover { text-decoration: underline; }
  /* COMMENT */
  .item-comment {
    font-size: 14px;
    color: #333;
    cursor: pointer;
    padding: 6px 8px;
    border: 1px solid transparent;
    border-radius: 2px;
    transition: border-color .15s, background .15s;
    position: relative;
    display: inline-block;
    min-width: 120px;}
  .item-comment:hover {border-color: #ccc;background: #fafafa;}
  .item-comment:hover::after { content: ' ✎';color: #888; font-size: 12px;}
  .comment-edit-area { display: none; margin-top: 10px; }
  .comment-edit-area textarea {
    width: 100%;
    min-height: 80px;
    border: 1px solid #666;
    padding: 10px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    outline: none;
  }
  .comment-edit-area textarea:focus { border-color: #333; }
  .item-menu {
    position: absolute;
    right: 8px;
    top: 40px;
    font-size: 20px;
    font-weight: 900;
    color: #555;
    cursor: pointer;
    padding: 4px 8px;
    letter-spacing: 1px;
  }
  .item-menu:hover { color: #111; }
  /* BOTTOM TOOLBAR */
  .list-toolbar-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
    padding-top: 12px;
  }
  /* SIDEBAR */
  .sidebar { width: 440px; flex-shrink: 0; }
  .sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 0;
    cursor: pointer;
    padding: 10px 0;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    user-select: none;}
  .sidebar-chevron {font-size: 14px;transition: transform .25s; color: #555;}
  .sidebar-chevron.open { transform: rotate(180deg); }
  .sidebar-body {overflow: hidden;max-height: 0;transition: max-height .35s ease;}
  .sidebar-body.open { max-height: 800px; }
  .sidebar-body-inner { padding: 20px 0 10px; }
  .manage-list {padding-left: 22px;margin-bottom: 22px;}
  .manage-list li {margin-bottom: 14px;font-size: 13px;line-height: 1.55;color: #333;}
  .sidebar-link {display: block;color: #a100a0;text-decoration: none;font-size: 13px;margin-bottom: 12px;}
  .sidebar-link:hover { text-decoration: underline; }
  .toggle-row {display: flex;align-items: center;gap: 14px;margin-bottom: 14px;}
  /* Toggle switch */
  .toggle-switch {position: relative;width: 44px;height: 24px;flex-shrink: 0;}
  .toggle-switch input { opacity: 0; width: 0; height: 0; }
  .toggle-track {
    position: absolute;
    inset: 0;
    background: #ccc;
    border-radius: 24px;
    cursor: pointer;
    transition: background .2s;
  }
  .toggle-track::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    top: 3px;
    left: 3px;
    transition: transform .2s;
    box-shadow: 0 1px 3px rgba(0,0,0,.3);
  }
  .toggle-switch input:checked + .toggle-track { background:green; }
  .toggle-switch input:checked + .toggle-track::after { transform: translateX(20px); }
  .toggle-label { font-size: 13px; line-height: 1.5; color: #222; }
  .sidebar-btn {
    width: 100%;
    height: 48px;
    margin-top: 10px;
    border: 1px solid #ccc;
    background: #f5f5f5;
    cursor: pointer;
    font-size: 15px;
    text-align: center;
    border-radius: 2px;
    transition: background .15s;
  }
  .sidebar-btn:hover { background: #ebebeb; }
  .delete-btn { color: #c40000; }
  .delete-btn:hover { background: #fff0f0; }
  @media (max-width: 960px) {
    .list-wrapper { flex-direction: column; }
    .sidebar { width: 100%; }
    .subnav { display: none; }
  }
</style>

<div class="list-wrapper">

  <div class="list-main">

    <div class="list-title">{{ $list->list_name }}</div>

    <div class="list-meta">
      <span>By</span>
      <span class="avatar">
          @if($list->image)
              <img src="{{ asset('uploads/avatars/' . $list->image) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 3px;" alt="Profile">
          @endif
      </span>
      <a href="{{ route('user.lists', ['user_id' => $list->user_id]) }}">{{ $list->username }}</a>
      <span>updated {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</span>
    </div>

    <div class="desc-display" id="descDisplay" title="Click to edit">
      <span id="descText">{{ $list->description ?? 'No description provided.' }}</span>
      <span class="edit-icon">✎</span>
    </div>

    <form action="{{ route('lists.update', $list->list_id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="desc-edit-area" id="descEditArea">
        <textarea id="descTextarea" name="description">{{ $list->description }}</textarea>
        <div class="action-row">
          <button class="btn-save" id="saveDesc" type="submit">Save</button>
          <button class="btn-cancel" id="cancelDesc" type="button">Cancel</button>
        </div>
      </div>
    </form>

    <div class="list-toolbar">
      <div class="toolbar-left">
        <span>Showing <b>1-{{ $items->count() }}</b> of {{ $items->count() }}</span>
        <button class="pager-btn">&#8592;</button>
        <button class="pager-btn">&#8594;</button>
      </div>
      <div class="toolbar-right">
        <span>Show</span>
        <select class="show-select" onchange="window.location.href='?show='+this.value">
          <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
          <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
          <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
        </select>
      </div>
    </div>

    @foreach($items as $i => $item)
    <div class="list-item">
      <div class="item-number">{{ $i+1 }}</div>
      <div class="item-cover">
        <img src="{{ $item->image_url }}" onerror="this.style.background='#ddd';this.removeAttribute('src')" alt="{{ $item->title }}">
      </div>
      <div class="item-content">
        <a href="{{ route('show.release', $item->release_id) }}" class="item-title">{{ $item->title }}</a>
        <div class="item-artist">{{ $item->artist }}</div>
        

        <!-- COMMENT -->
        <div class="item-comment" id="commentDisplay-{{ $item->release_id }}" title="Click to edit comment" onclick="editComment({{ $item->release_id }})">{{ $itemComments[$item->release_id] ?? '' }}</div>

        <form action="{{ route('lists.updateComment', [$list->list_id, $item->release_id]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="comment-edit-area" id="commentEditArea-{{ $item->release_id }}" style="display: none;">
            <textarea id="commentTextarea-{{ $item->release_id }}" name="comments">{{ $itemComments[$item->release_id] ?? '' }}</textarea>
            <div class="action-row">
              <button class="btn-save" type="submit">Save</button>
              <button class="btn-cancel" type="button" onclick="cancelComment({{ $item->release_id }})">Cancel</button>
            </div>
          </div>
        </form>
      </div>
      <div class="item-menu dropdown">
        <div data-bs-toggle="dropdown" aria-expanded="false">•••</div>
        <ul class="dropdown-menu dropdown-menu-end">
          @if(auth()->check() && auth()->id() == $list->user_id)
          <li>
            <form action="{{ route('lists.removeRelease', [$list->list_id, $item->release_id]) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus item ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="dropdown-item text-danger" style="background: none; border: none; width: 100%; text-align: left;">Remove</button>
            </form>
          </li>
          @else
          <li><span class="dropdown-item text-muted">No actions available</span></li>
          @endif
        </ul>

        <div class="comment-container">
          <!-- <div class="item-comment comment-display-trigger" title="Click to edit comment">
            {{ $itemComments[$item->release_id] ?? 'Add a comment...' }}
          </div> -->

          <form action="{{ route('lists.updateComment', [$list->list_id, $item->release_id]) }}" method="POST" class="comment-form-area" style="display:none; margin-top:10px;">
            @csrf
            @method('PUT')
            <div class="comment-edit-area" style="display:block;">
              <textarea name="comments" class="comment-textarea">{{ $itemComments[$item->release_id] ?? '' }}</textarea>
              <div class="action-row">
                <button class="btn-save" type="submit">Save</button>
                <button class="btn-cancel comment-cancel-btn" type="button">Cancel</button>
              </div>
            </div>
          </form>
        </div>


      </div>
    </div>
    @endforeach

    <div class="list-toolbar-bottom">
      <div class="toolbar-left">
        <span>Showing <b>1-{{ $items->count() }}</b> of {{ $items->count() }}</span>
        <button class="pager-btn">&#8592;</button>
        <button class="pager-btn">&#8594;</button>
      </div>
    </div>

  </div>

  <div class="sidebar">
    <div class="sidebar-header" id="manageToggle">
      <span>Manage List</span>
      <span class="sidebar-chevron" id="sidebarChevron">&#8963;</span>
    </div>

    <div class="sidebar-body" id="sidebarBody">
      <div class="sidebar-body-inner">

        <ul class="manage-list">
          <li>Hover on the title or description then click to edit.</li>
          <li>Hover on an item's comments and click to edit, or click "remove" to remove.</li>
          <li>Use drag and drop to re-order the items in your list, or click "move to," type a new position, and press enter.</li>
        </ul>

        <a href="{{ auth()->check() ? route('user.lists', ['user_id' => auth()->id()]) : '/login' }}" class="sidebar-link">View all of my lists</a>
        <a href="/submissions" class="sidebar-link">View Submissions</a>


      @if(auth()->check() && auth()->id() == $list->user_id)
      <form action="{{ route('lists.destroy', $list->list_id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus list ini?')">
          @csrf
          @method('DELETE')
        <button type="submit" class="sidebar-btn delete-btn" style="margin-top: 15px;">🗑 Delete This List</button>
      </form>
      @endif

        <form action="{{ route('lists.destroy', $list->list_id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus list ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="sidebar-btn delete-btn">🗑 Delete This List</button>
        </form>


      </div>
    </div>
  </div>

</div>

<script>
  // ---- DESCRIPTION INLINE EDIT ----
  const descDisplay   = document.getElementById('descDisplay');
  const descEditArea  = document.getElementById('descEditArea');
  const descText      = document.getElementById('descText');
  const descTextarea  = document.getElementById('descTextarea');
  const cancelDesc    = document.getElementById('cancelDesc');


  descDisplay.addEventListener('click', function () {
    descTextarea.value = descText.textContent.trim();
    descDisplay.style.display = 'none';
    descEditArea.style.display = 'block';
    descTextarea.focus();
  });

  cancelDesc.addEventListener('click', function () {
    descEditArea.style.display = 'none';
    descDisplay.style.display = 'block';
  });

  saveDesc.addEventListener('click', function () {
    descText.textContent = descTextarea.value || '';
    cancelDesc.click();
  });

  // ---- COMMENT INLINE EDIT ----
  function editComment(releaseId) {
    const display = document.getElementById('commentDisplay-' + releaseId);
    const editArea = document.getElementById('commentEditArea-' + releaseId);
    const textarea = document.getElementById('commentTextarea-' + releaseId);

    textarea.value = display.textContent.trim();
    display.style.display = 'none';
    editArea.style.display = 'block';
    textarea.focus();
  }

  function cancelComment(releaseId) {
    document.getElementById('commentEditArea-' + releaseId).style.display = 'none';
    document.getElementById('commentDisplay-' + releaseId).style.display = 'inline-block';
  }
=======
  if(descDisplay) {
    descDisplay.addEventListener('click', function () {
      descDisplay.style.display = 'none';
      descEditArea.style.display = 'block';
      descTextarea.focus();
    });
  }

  if(cancelDesc) {
    cancelDesc.addEventListener('click', function () {
      descEditArea.style.display = 'none';
      descDisplay.style.display = 'block';
    });
  }

  // ---- MULTI-ITEM COMMENT INLINE EDIT (Berfungsi untuk semua row item) ----
  document.querySelectorAll('.comment-display-trigger').forEach(trigger => {
    trigger.addEventListener('click', function() {
      const container = this.closest('.comment-container');
      const formArea = container.querySelector('.comment-form-area');
      const textarea = container.querySelector('.comment-textarea');
      
      this.style.display = 'none';
      formArea.style.display = 'block';
      textarea.focus();
    });
  });

  document.querySelectorAll('.comment-cancel-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const container = this.closest('.comment-container');
      const trigger = container.querySelector('.comment-display-trigger');
      const formArea = container.querySelector('.comment-form-area');
      
      formArea.style.display = 'none';
      trigger.style.display = 'inline-block';
    });
  });


  // ---- MANAGE LIST TOGGLE ----
  const manageToggle   = document.getElementById('manageToggle');
  const sidebarBody    = document.getElementById('sidebarBody');
  const sidebarChevron = document.getElementById('sidebarChevron');

  if(manageToggle) {
    manageToggle.addEventListener('click', function () {
      const isOpen = sidebarBody.classList.toggle('open');
      sidebarChevron.classList.toggle('open', isOpen);
    });
  }

  // Open by default
  sidebarBody.classList.add('open');
  sidebarChevron.classList.add('open');
</script>
@endsection