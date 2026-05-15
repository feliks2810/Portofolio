{{-- Project Detail Modal --}}
<div id="project-modal" class="fixed inset-0 z-50 hidden" onclick="if(event.target===this)closeProjectModal()">
  <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
  <div class="relative flex items-center justify-center min-h-screen p-4">
    <div class="bg-gray-900 border border-white/10 rounded-2xl w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
      {{-- Modal image --}}
      <img id="modal-image" src="" alt="" class="w-full h-56 object-cover rounded-t-2xl hidden" />

      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div>
            <p id="modal-category" class="text-blue-400 text-xs font-semibold uppercase tracking-wider mb-1"></p>
            <h3 id="modal-title" class="text-2xl font-bold text-white"></h3>
          </div>
          <button onclick="closeProjectModal()" class="text-gray-500 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/5 ml-4 flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <p id="modal-description" class="text-gray-400 text-sm leading-relaxed mb-5"></p>

        <div class="mb-5">
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tech Stack</p>
          <div id="modal-stack" class="flex flex-wrap gap-2"></div>
        </div>

        <div class="mb-6">
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Key Features</p>
          <ul id="modal-features" class="space-y-1.5"></ul>
        </div>

        <div class="flex gap-3 pt-4 border-t border-white/5">
          <a id="modal-demo" href="#" target="_blank" class="btn-primary text-sm flex items-center gap-2 hidden">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Live Demo
          </a>
          <a id="modal-github" href="#" target="_blank" class="btn-outline text-sm flex items-center gap-2 hidden">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
            View Code
          </a>
          <button onclick="closeProjectModal()" class="btn-outline text-sm ml-auto">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
