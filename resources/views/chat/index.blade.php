<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Chat <span id="msgCount"></span></strong>
        <button id="toggleBtn" class="btn btn-default btn-xs pull-right">Toggle</button>
    </div>
    <div id="chatUi">
        <div class="panel-body" id="chat">
            {{-- Mesazhet --}}
            <ul id="messages"></ul>
        </div>
        <div class="panel-footer">
            <form method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
                <div class="form-group">
                    <textarea class="form-control" id="message" required></textarea>
                </div>
                <input type="submit" class="btn btn-primary" id="sendMessage" value="Dergo">
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/chat.js') }}"></script>