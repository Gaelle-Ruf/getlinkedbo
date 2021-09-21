# Systématiquement faire un git pull sur develop


Pour commit / merge :
Sur la branche de la feature :
git add .
git commit [FIX], [UPDATE], [NEW], [REMOVE]
git push (la branche apparaît sur GitHub)
git checkout develop (retourner sur la branche develop)
git pull (récupérer les modifications de develop)
git merge --no-ff feature/nom-de-la-feature (merge les modification sur develop)
git push origin develop (push sur develop)