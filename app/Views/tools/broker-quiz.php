<?php
// broker-quiz.php — $brokersJson passed from ToolsController
?>
<!-- Broker Quiz -->
<section class="tool-hero">
    <div class="container">
        <h1>Find Your Perfect Forex Broker</h1>
        <p>Answer 5 quick questions and we'll match you with the best broker for your trading style and needs.</p>
    </div>
</section>

<section style="padding:2rem 0 4rem">
    <div class="container">
        <div class="quiz-card" id="quizCard">
            <div class="quiz-progress">
                <div class="quiz-progress-fill" id="quizProgress" style="width:0%"></div>
            </div>
            <div id="quizStepLabel" style="font-size:.78rem;color:var(--text-muted);margin-bottom:1rem">Question 1 of 5</div>

            <!-- Step 1 -->
            <div class="quiz-step active" data-step="1">
                <div class="quiz-question">What is your forex trading experience?</div>
                <div class="quiz-options">
                    <div class="quiz-option" data-key="experience" data-val="beginner">🌱 Beginner — I'm just starting out</div>
                    <div class="quiz-option" data-key="experience" data-val="intermediate">📈 Intermediate — I've been trading for 1–3 years</div>
                    <div class="quiz-option" data-key="experience" data-val="advanced">🏆 Advanced — I'm an experienced trader</div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="quiz-step" data-step="2">
                <div class="quiz-question">How much do you plan to deposit initially?</div>
                <div class="quiz-options">
                    <div class="quiz-option" data-key="deposit" data-val="low">💵 Under $100</div>
                    <div class="quiz-option" data-key="deposit" data-val="mid">💰 $100 – $1,000</div>
                    <div class="quiz-option" data-key="deposit" data-val="high">🏦 Over $1,000</div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="quiz-step" data-step="3">
                <div class="quiz-question">Do you require an Islamic (swap-free) account?</div>
                <div class="quiz-options">
                    <div class="quiz-option" data-key="islamic" data-val="yes">☪️ Yes — I need a halal account</div>
                    <div class="quiz-option" data-key="islamic" data-val="no">✗ No — standard account is fine</div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="quiz-step" data-step="4">
                <div class="quiz-question">Which trading platform do you prefer?</div>
                <div class="quiz-options">
                    <div class="quiz-option" data-key="platform" data-val="mt4">MetaTrader 4 (MT4)</div>
                    <div class="quiz-option" data-key="platform" data-val="mt5">MetaTrader 5 (MT5)</div>
                    <div class="quiz-option" data-key="platform" data-val="any">No preference / any</div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="quiz-step" data-step="5">
                <div class="quiz-question">What matters most to you in a broker?</div>
                <div class="quiz-options">
                    <div class="quiz-option" data-key="priority" data-val="regulation">🛡️ Strong regulation and safety</div>
                    <div class="quiz-option" data-key="priority" data-val="spreads">⚡ Low spreads and fast execution</div>
                    <div class="quiz-option" data-key="priority" data-val="education">📚 Education and beginner support</div>
                    <div class="quiz-option" data-key="priority" data-val="leverage">🔁 High leverage</div>
                </div>
            </div>

            <!-- Results -->
            <div class="quiz-step" data-step="results">
                <h3 style="margin-bottom:1rem;font-size:1.05rem">Your Top Broker Matches</h3>
                <div id="quizResults" class="quiz-results"></div>
                <button id="quizRestart" style="margin-top:1.25rem;padding:.55rem 1.25rem;background:transparent;border:1px solid var(--border);border-radius:7px;cursor:pointer;font-size:.88rem;color:var(--text-main)">
                    &#8635; Start Over
                </button>
            </div>
        </div>
    </div>
</section>

<?php $pageScripts = <<<JSEOF
<script>
(function() {
    var brokers = {$brokersJson};
    var answers = {};
    var currentStep = 1;
    var totalSteps = 5;

    function showStep(n) {
        document.querySelectorAll('.quiz-step').forEach(function(s) { s.classList.remove('active'); });
        var el = document.querySelector('.quiz-step[data-step="' + (n === 'results' ? 'results' : n) + '"]');
        if (el) el.classList.add('active');
        if (n !== 'results') {
            document.getElementById('quizStepLabel').textContent = 'Question ' + n + ' of ' + totalSteps;
            document.getElementById('quizProgress').style.width = ((n-1)/totalSteps*100) + '%';
        } else {
            document.getElementById('quizStepLabel').textContent = 'Your results';
            document.getElementById('quizProgress').style.width = '100%';
            showResults();
        }
    }

    document.querySelectorAll('.quiz-option').forEach(function(opt) {
        opt.addEventListener('click', function() {
            var key = opt.dataset.key, val = opt.dataset.val;
            answers[key] = val;
            var stepEl = opt.closest('.quiz-step');
            stepEl.querySelectorAll('.quiz-option').forEach(function(o) { o.classList.remove('selected'); });
            opt.classList.add('selected');
            setTimeout(function() {
                currentStep++;
                if (currentStep > totalSteps) showStep('results');
                else showStep(currentStep);
            }, 300);
        });
    });

    function scorebroker(b) {
        var score = (parseFloat(b.overall_rating) || 0) * 10;
        var platforms = (b.platforms || '').toLowerCase();

        if (answers.islamic === 'yes' && b.has_islamic != 1) return -1;

        var dep = parseFloat(b.min_deposit) || 0;
        if (answers.deposit === 'low' && dep <= 10) score += 20;
        else if (answers.deposit === 'low' && dep <= 50) score += 10;
        else if (answers.deposit === 'mid' && dep <= 200) score += 15;
        else if (answers.deposit === 'high') score += 10;

        if (answers.platform === 'mt4' && platforms.includes('mt4')) score += 20;
        if (answers.platform === 'mt5' && platforms.includes('mt5')) score += 20;
        if (answers.platform === 'any') score += 10;

        if (answers.priority === 'regulation' && b.regulation) score += 15;
        if (answers.priority === 'leverage') {
            var lev = parseInt((b.max_leverage||'').replace(/[^0-9]/,'')) || 0;
            if (lev >= 500) score += 20;
            else if (lev >= 200) score += 10;
        }
        if (answers.priority === 'education' && answers.experience === 'beginner') score += 15;
        if (answers.priority === 'spreads') score += 10;

        return score;
    }

    function showResults() {
        var scored = brokers.map(function(b) { return { b:b, score: scorebroker(b) }; })
            .filter(function(x) { return x.score > 0; })
            .sort(function(a,b) { return b.score - a.score; })
            .slice(0, 5);

        var container = document.getElementById('quizResults');
        if (!scored.length) {
            container.innerHTML = '<p style="color:var(--text-muted)">No exact matches found. <a href="/brokers">View all brokers</a>.</p>';
            return;
        }
        container.innerHTML = '';
        function esc(s) {
            return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
        }
        scored.forEach(function(item, idx) {
            var b = item.b;
            var div = document.createElement('div');
            div.className = 'quiz-result-broker';

            /* Build logo safely — use DOM methods to avoid innerHTML injection */
            var logoWrap = document.createElement('div');
            logoWrap.style.cssText = 'width:60px;height:40px;flex-shrink:0';
            if (b.logo) {
                var img = document.createElement('img');
                img.src = b.logo;                          /* src is a URL, not HTML */
                img.alt = esc(b.name) + ' logo';
                img.style.cssText = 'width:60px;height:40px;object-fit:contain';
                logoWrap.appendChild(img);
            } else {
                logoWrap.style.cssText += ';background:var(--border);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.65rem;color:var(--text-muted)';
                logoWrap.textContent = b.name.slice(0, 4);
            }

            var info = document.createElement('div');
            info.className = 'quiz-result-broker-info';

            var strong = document.createElement('strong');
            strong.textContent = b.name;
            if (idx === 0) {
                var badge = document.createElement('span');
                badge.style.cssText = 'font-size:.68rem;background:var(--accent);color:var(--navy-dark);padding:.12rem .45rem;border-radius:4px;font-weight:700;margin-left:.4rem';
                badge.textContent = 'Best Match';
                strong.appendChild(badge);
            }
            var meta = document.createElement('span');
            meta.textContent = 'Min deposit: $' + (b.min_deposit || '—') + ' · Rating: ' + (b.overall_rating || '—') + '/10';
            info.appendChild(strong);
            info.appendChild(meta);

            var link = document.createElement('a');
            link.href = '/brokers/' + encodeURIComponent(b.slug);
            link.style.cssText = 'font-size:.82rem;font-weight:600;color:var(--accent);text-decoration:none;white-space:nowrap';
            link.textContent = 'Review →';

            div.appendChild(logoWrap);
            div.appendChild(info);
            div.appendChild(link);
            container.appendChild(div);
        });
    }

    document.getElementById('quizRestart').addEventListener('click', function() {
        answers = {}; currentStep = 1;
        document.querySelectorAll('.quiz-option').forEach(function(o) { o.classList.remove('selected'); });
        showStep(1);
    });
})();
</script>
JSEOF;
?>
