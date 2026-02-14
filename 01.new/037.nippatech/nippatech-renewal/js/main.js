document.addEventListener('DOMContentLoaded', () => {
    // 画面上の数字要素をすべて取得
    const targets = document.querySelectorAll('.infographic-item__number');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;

                // --- 1. 目標値（ゴール）の設定 ---
                let targetVal = 0;

                // data-target="current-year" なら今年の西暦を取得
                if (el.dataset.target === 'current-year') {
                    targetVal = new Date().getFullYear(); 
                } else if (el.dataset.target) {
                    targetVal = parseInt(el.dataset.target, 10);
                } else {
                    targetVal = parseInt(el.textContent.replace(/,/g, ''), 10);
                }

                // --- 2. 開始値の設定 ---
                let startVal = 0;
                if (el.dataset.start) {
                    startVal = parseInt(el.dataset.start, 10);
                }

                // --- 3. カンマ表示の設定 ---
                const useComma = el.dataset.comma !== 'false';

                if (isNaN(targetVal)) targetVal = 0;
                if (isNaN(startVal)) startVal = 0;

                // --- アニメーション設定 ---
                const duration = 2000; // 2秒かけて動く
                const startTime = performance.now();

                const animate = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    
                    const currentNum = Math.floor(startVal + (targetVal - startVal) * ease);

                    // --- 表示の更新 ---
                    if (useComma) {
                        el.textContent = currentNum.toLocaleString('en-US');
                    } else {
                        el.textContent = currentNum.toString();
                    }

                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    } else {
                        // 最終的な値をセット
                        if (useComma) {
                            el.textContent = targetVal.toLocaleString('en-US');
                        } else {
                            el.textContent = targetVal.toString();
                        }
                    }
                };

                requestAnimationFrame(animate);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    targets.forEach(target => observer.observe(target));
});