var assert = chai.assert;

describe('LessPass v2', function() {
  describe('set of characters', function() {
    it('get default set of characters', function() {
      var setOfCharacters = LessPass._getSetOfCharacters();
      assert.equal(
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~',
        setOfCharacters
      );
      assert.equal(26 * 2 + 10 + 32, setOfCharacters.length);
    });
    it('get default set of characters concat rules in order', function() {
      var setOfCharacters = LessPass._getSetOfCharacters(['lowercase', 'uppercase', 'numbers']);
      assert.equal('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', setOfCharacters);
      assert.equal(26 * 2 + 10, setOfCharacters.length);
    });
    it('get set of characters only lowercase', function() {
      var setOfCharacters = LessPass._getSetOfCharacters(['lowercase']);
      assert.equal('abcdefghijklmnopqrstuvwxyz', setOfCharacters);
      assert.equal(26, setOfCharacters.length);
    });
    it('get set of characters only uppercase', function() {
      var setOfCharacters = LessPass._getSetOfCharacters(['uppercase']);
      assert.equal('ABCDEFGHIJKLMNOPQRSTUVWXYZ', setOfCharacters);
      assert.equal(26, setOfCharacters.length);
    });
    it('get set of characters only numbers', function() {
      var setOfCharacters = LessPass._getSetOfCharacters(['numbers']);
      assert.equal('0123456789', setOfCharacters);
      assert.equal(10, setOfCharacters.length);
    });
    it('get set of characters only symbols', function() {
      var setOfCharacters = LessPass._getSetOfCharacters(['symbols']);
      assert.equal('!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~', setOfCharacters);
      assert.equal(32, setOfCharacters.length);
    });
    it('generate one char per rules', function() {
      var oneCharPerSetOfCharacters = LessPass._getOneCharPerRule(
        bigInt(26 * 26),
        ['lowercase', 'uppercase']
      );
      assert.equal('aA', oneCharPerSetOfCharacters.value);
      assert.equal(2, oneCharPerSetOfCharacters.value.length);
      assert.equal(1, oneCharPerSetOfCharacters.entropy);
    });
    it('configured rules', function() {
      assert.deepEqual(['uppercase'], LessPass._getConfiguredRules({uppercase: true}));
      assert.deepEqual(['lowercase', 'uppercase'], LessPass._getConfiguredRules({uppercase: true, lowercase: true}));
      assert.deepEqual(['lowercase'], LessPass._getConfiguredRules({lowercase: true, symbols: false}));
      assert.deepEqual(['lowercase', 'uppercase', 'numbers', 'symbols'], LessPass._getConfiguredRules({
        lowercase: true,
        uppercase: true,
        symbols: true,
        numbers: true
      }));
    });
  });
});
