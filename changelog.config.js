module.exports = {
  disableEmoji: false,
  format: '{emoji} {type}{scope}: {subject}',
  list: ['test', 'feat', 'fix', 'chore', 'docs', 'refactor', 'style', 'ci', 'perf', 'new', 'improve', 'breaking'],
  maxMessageLength: 64,
  minMessageLength: 3,
  questions: ['type', 'scope', 'subject', 'body', 'breaking', 'issues', 'lerna'],
  scopes: [],
  types: {
    chore: {
      description: 'Modifications des processus de construction ou des outils auxiliaires',
      emoji: '🤖',
      value: 'CHRORE'
    },
    ci: {
      description: 'Modifications liées à l’intégration continue',
      emoji: '🎡',
      value: 'CI'
    },
    docs: {
      description: 'Modifications de documentation uniquement',
      emoji: '📖',
      value: 'DOCS'
    },
    feat: {
      description: 'Une nouvelle fonctionnalité',
      emoji: '📦',
      value: 'FEAT'
    },
    fix: {
      description: 'Une correction de bogue',
      emoji: '🐛',
      value: 'FIX'
    },
    perf: {
      description: 'Une modification de code qui améliore les performances',
      emoji: '⚡️',
      value: 'PERF'
    },
    refactor: {
      description: 'Une modification de code qui ne corrige pas de bogue ni n’ajoute de fonctionnalité',
      emoji: '👌',
      value: 'REFRACTOR'
    },
    release: {
      description: 'Créer un commit de version',
      emoji: '🚀',
      value: 'RELEASE'
    },
    style: {
      description: 'Balisage, espaces blancs, mise en forme, point-virgules manquants...',
      emoji: '💄',
      value: 'STYLE'
    },
    test: {
      description: 'Ajout de tests manquants',
      emoji: '🤖',
      value: 'TEST'
    },
    new: {
      description: 'Un ajout',
      emoji: '📦',
      value: 'NEW'
    },
    improve: {
      description: 'Une amélioration',
      emoji: '👌',
      value: 'INPROVE'
    },
    breaking: {
      description: 'Un changement important',
      emoji: '‼️',
      value: 'BREAKING'
    },
    messages: {
      type: 'Sélectionnez le type de modification que vous effectuez :',
      customScope: 'Sélectionnez la portée de cette modification :',
      subject: 'Rédigez une description courte et impérative de la modification :\n',
      body: 'Fournissez une description plus détaillée de la modification :\n ',
      breaking: 'Listez les changements impactants :\n',
      footer: 'Problèmes clos par ce commit, par exemple #123 :',
      confirmCommit: 'Les paquets affectés par ce commit\n',
    },
  }
};
